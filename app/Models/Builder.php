<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\City;
use App\Models\Country;
use App\Models\CountryStateModal;

class Builder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'registration_number',
        'phone_number',
        'business_type',
        'city_id',
        'state_id',
        'country_id',
        'address',
        'website',
        'company_logo',
        'description',
        'gstin',
        'pan_number',
        'business_registration_doc',
        'status',
        'verified_at',
        'verified_by'
    ];

    protected $casts = [
        'verified_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(CountryStateModal::class, 'state_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function isVerified()
    {
        return $this->status == 1 && $this->verified_at !== null;
    }

    public function getFullAddressAttribute()
    {
        return $this->address . ', '
            . ($this->city->name ?? '') . ', '
            . ($this->state->name ?? '') . ', '
            . ($this->country->name ?? '');
    }
}