<?php

namespace App\Models;
use App\Models\CompanyProfile;
use App\Models\CountryStateModal;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'provider_avatar',
        'status',
        'email_verified',
        'login_type',
        'user_name',
        'verify_token',
        'forget_password_token',
        'city_id',
        'state_id',
        'country_id',
        'aadhaar_number',
        'pan_number',
        'bank_name',
        'account_number',
        'ifsc_code',
        'upi_id',
        'office_address',
        'rera_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['image_url', 'dashboard_type', 'can_add_property', 'can_book_property', 'agent_request_status', 'agent_request_label', 'profile_completion_percentage'];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            $setting = \App\Models\Setting::first();
            return $setting->default_avatar ? url($setting->default_avatar) : null;
        }
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }
        return url($this->image);
    }

    public function getDashboardTypeAttribute(): string
    {
        return match($this->login_type) {
            'builder' => 'builder',
            'agent' => 'agent',
            default => 'customer'
        };
    }

    public function getCanAddPropertyAttribute(): bool
    {
        return in_array($this->login_type, ['agent', 'builder']);
    }

    public function getCanBookPropertyAttribute(): bool
    {
        return $this->login_type === 'user';
    }

    public function getAgentRequestStatusAttribute(): string
    {
        if ($this->is_agency == 1 && $this->login_type === 'agent') {
            return 'approved';
        }
        if ($this->is_agency == 2 && $this->login_type === 'user') {
            return 'pending';
        }
        if ($this->is_agency == 0 && $this->login_type === 'user') {
            $profile = $this->profile()->first();
            if ($profile && $profile->is_approved == 0) {
                return 'rejected';
            }
        }
        return 'not_applied';
    }

    public function getAgentRequestLabelAttribute(): string
    {
        return match ($this->agent_request_status) {
            'approved' => 'Approved',
            'pending' => 'Pending Admin Approval',
            'rejected' => 'Rejected',
            default => 'Not Applied',
        };
    }

    public function builder(){
        return $this->hasOne(Builder::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function state(){
        return $this->belongsTo(CountryStateModal::class, 'state_id');
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function profile(){
        return $this->hasOne(CompanyProfile::class, 'user_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Allowed roles for authentication.
     */
    public const ROLES = ['user', 'agent', 'builder', 'admin'];

    /**
     * Check if user has the given role (login_type).
     */
    public function hasRole(string $role): bool
    {
        return $this->login_type === $role;
    }

    /**
     * Check if user is a builder (by login_type).
     */
    public function isBuilder(): bool
    {
        return $this->login_type === 'builder';
    }

    /**
     * Check if user is admin.
     */
    public function isAdmin(): bool
    {
        return $this->login_type === 'admin';
    }

    /**
     * Check if user is agent.
     */
    public function isAgent(): bool
    {
        return $this->login_type === 'agent';
    }

    /**
     * Get dashboard route based on user type
     */
    /**
     * Calculate profile completion percentage based on role
     */
    public function getProfileCompletionPercentageAttribute(): int
    {
        $fields = ['name', 'email', 'phone', 'image', 'address'];

        if ($this->login_type === 'agent') {
            $fields = array_merge($fields, ['aadhaar_number', 'pan_number', 'bank_name', 'account_number', 'ifsc_code', 'office_address']);
        } else {
            $fields = array_merge($fields, ['aadhaar_number', 'pan_number', 'bank_name', 'account_number', 'ifsc_code']);
        }

        $filled = 0;
        foreach ($fields as $field) {
            if (!empty($this->$field)) {
                $filled++;
            }
        }

        return (int) round(($filled / count($fields)) * 100);
    }

    protected static function booted()
    {
        static::created(function ($user) {
            try {
                $hasActiveOrder = \App\Models\Order::where('agent_id', $user->id)->where('order_status', 'active')->exists();
                if (!$hasActiveOrder) {
                    $freePlan = \App\Models\PricingPlan::where('plan_price', 0)->where('status', 'enable')->first() 
                               ?? \App\Models\PricingPlan::where('plan_type', 'free')->where('status', 'enable')->first();
                    if ($freePlan) {
                        $order = new \App\Models\Order();
                        $order->order_id = substr(rand(0, time()), 0, 10);
                        $order->agent_id = $user->id;
                        $order->pricing_plan_id = $freePlan->id;
                        $order->plan_type = $freePlan->plan_type;
                        $order->plan_price = $freePlan->plan_price;
                        $order->plan_name = $freePlan->plan_name;
                        $order->expired_time = $freePlan->expired_time ?? 'lifetime';
                        $order->number_of_property = $freePlan->number_of_property;
                        $order->featured_property = $freePlan->featured_property ?? 'disable';
                        $order->featured_property_qty = $freePlan->featured_property_qty ?? 0;
                        $order->top_property = $freePlan->top_property ?? 'disable';
                        $order->top_property_qty = $freePlan->top_property_qty ?? 0;
                        $order->urgent_property = $freePlan->urgent_property ?? 'disable';
                        $order->urgent_property_qty = $freePlan->urgent_property_qty ?? 0;
                        $order->max_agent_add = $freePlan->max_agent_add ?? 0;
                        $order->order_status = 'active';
                        $order->payment_status = 'success';
                        $order->transaction_id = 'free_welcome_enroll';
                        $order->payment_method = 'Free';
                        $order->expiration_date = 'lifetime';
                        $order->save();
                    }
                }
            } catch (\Exception $e) {
                \Log::error('Default free plan error: ' . $e->getMessage());
            }
        });
    }
}

