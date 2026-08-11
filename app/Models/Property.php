<?php

namespace App\Models;

use App\Traits\TraitsForTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory, TraitsForTranslation;

    public function property_type(){
        return $this->belongsTo(Category::class, 'property_type_id');
    }

    public function agent(){
        return $this->belongsTo(User::class, 'agent_id')->select('id', 'name', 'phone', 'email','designation','image', 'user_name');
    }

    public function reviews(){
        return $this->hasMany(Review::class)->where('status', 1);
    }

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }

    public function sliders(){
        return $this->hasMany(PropertySlider::class, 'property_id');
    }

    public function aminities(){
        return $this->hasMany(PropertyAminity::class, 'property_id');
    }

    public function nearest_locations(){
        return $this->hasMany(PropertyNearestLocation::class, 'property_id');
    }

    public function additional_informations(){
        return $this->hasMany(AdditionalInformation::class, 'property_id');
    }

    public function property_plans(){
        return $this->hasMany(PropertyPlan::class, 'property_id');
    }

    protected $appends = [
        'totalRating',
        'ratingAvarage',
        'thumbnail_image_url',
        'availability_label',
        'can_book',
        'formatted_price',
        'currency_code',
        'currency_symbol',
        'currency',
        'dynamic_status',
        'wishlist_count',
        'booking_count',
        'review_count',
        'interest_count',
        'view_count',
        'share_count',
        'last_updated'
    ];

    public function getTotalRatingAttribute()
    {
        return $this->reviews()->count();
    }

    public function getRatingAvarageAttribute()
    {
        return $this->reviews()->avg('rating');
    }

    public function getThumbnailImageUrlAttribute()
    {
        if (!$this->thumbnail_image) {
            $setting = \App\Models\Setting::first();
            return $setting->default_placeholder ? url($setting->default_placeholder) : null;
        }
        if (str_starts_with($this->thumbnail_image, 'http://') || str_starts_with($this->thumbnail_image, 'https://')) {
            return $this->thumbnail_image;
        }
        return url($this->thumbnail_image);
    }

    public function getDynamicStatusAttribute()
    {
        if ($this->approve_by_admin === 'pending') {
            return 'Pending Approval';
        }
        if ($this->approve_by_admin === 'reject') {
            return 'Rejected';
        }
        if ($this->status === 'disable') {
            return 'Draft';
        }
        if ($this->expired_date !== null && $this->expired_date < date('Y-m-d')) {
            return 'Expired';
        }
        return ucfirst($this->availability_status ?? 'available');
    }

    public function getWishlistCountAttribute()
    {
        return \App\Models\Wishlist::where('property_id', $this->id)->count();
    }

    public function getBookingCountAttribute()
    {
        return \App\Models\Booking::where('property_id', $this->id)->count();
    }

    public function getReviewCountAttribute()
    {
        return $this->reviews()->count();
    }

    public function getInterestCountAttribute()
    {
        return $this->getWishlistCountAttribute() + $this->getBookingCountAttribute();
    }

    public function getViewCountAttribute()
    {
        return 0;
    }

    public function getShareCountAttribute()
    {
        return 0;
    }

    public function getLastUpdatedAttribute()
    {
        return $this->updated_at ? $this->updated_at->diffForHumans() : '';
    }

    public function getAvailabilityLabelAttribute()
    {
        $status = $this->availability_status ?? 'available';
        return ucfirst($status);
    }

    public function getCanBookAttribute()
    {
        return ($this->availability_status ?? 'available') === 'available';
    }

    public function getFormattedPriceAttribute()
    {
        return num_format($this->price);
    }

    public function getCurrencyCodeAttribute()
    {
        $currency_code = '';
        if (function_exists('session') && request()->hasSession()) {
            $currency_code = session()->get('currency_code');
        }
        if (empty($currency_code)) {
            $setting = \App\Models\Setting::first();
            $currency_code = $setting->currency_name ?? 'INR';
        }
        return $currency_code;
    }

    public function getCurrencySymbolAttribute()
    {
        $currency_icon = '';
        if (function_exists('session') && request()->hasSession()) {
            $currency_icon = session()->get('currency_icon');
        }
        if (empty($currency_icon)) {
            $setting = \App\Models\Setting::first();
            $currency_icon = $setting->currency_icon ?? '₹';
        }
        return $currency_icon;
    }

    public function getCurrencyAttribute()
    {
        return $this->getCurrencySymbolAttribute();
    }

    protected $casts =  [
        'id' => 'integer',
        'agent_id' => 'integer',
        'property_type_id' => 'integer',
        'city_id' => 'integer',
        'serial' => 'integer',
        'totalRating' => 'integer',
        'ratingAvarage' => 'double',
        'can_book' => 'boolean',
    ];

    public function getStatusBadgeAttribute()
    {
        $status = strtolower($this->property_status_state ?? ($this->approve_by_admin === 'approved' ? 'live' : 'pending'));
        if ($this->availability_status === 'sold') $status = 'sold';
        if ($this->availability_status === 'rented') $status = 'rented';

        return match($status) {
            'live', 'approved' => ['label' => 'Live', 'class' => 'badge-success'],
            'booked' => ['label' => 'Booked', 'class' => 'badge-warning'],
            'sold' => ['label' => 'Sold', 'class' => 'badge-danger'],
            'rented' => ['label' => 'Rented', 'class' => 'badge-info'],
            'draft' => ['label' => 'Draft', 'class' => 'badge-secondary'],
            default => ['label' => 'Pending Approval', 'class' => 'badge-primary'],
        };
    }
}
