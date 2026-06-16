<?php

namespace App\Models;
use App\Models\Agent;
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
        'country_id'
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

    public function seller(){
        return $this->hasOne(Vendor::class);
    }

    public function agent(){
        return $this->hasOne(Agent::class);
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
    public function getDashboardRoute(): string
    {
        return match($this->login_type) {
            'builder' => 'builder.dashboard',
            'agent' => 'agent.dashboard',
            'admin' => 'admin.dashboard',
            default => 'user.dashboard'
        };
    }
}
