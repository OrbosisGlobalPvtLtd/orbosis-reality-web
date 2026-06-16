<?php

namespace App\Models;

use App\Models\Country;
use App\Models\CountryStateModal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'slug', 
        'country_id', 
        'country_state_id'
    ];

    protected $appends = ['totalProperty'];

    /**
     * Get total properties count.
     */
    public function getTotalPropertyAttribute()
    {
        return $this->properties()->count();
    }

    /**
     * City has many properties.
     */
    public function properties(){
        return $this->hasMany(Property::class, 'city_id')->where(function ($query) {
            $query->where('expired_date', null)
                ->orWhere('expired_date', '>=', date('Y-m-d'));
        })->where('approve_by_admin', 'approved')->where('status', 'enable');
    }

    /**
     * City belongs to a country.
     */
    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * City belongs to a state (country_state).
     * Uses country_state_id column from database.
     */
    public function state(){
        return $this->belongsTo(CountryStateModal::class, 'country_state_id');
    }

    protected $casts = [
        'id' => 'integer',
        'totalProperty' => 'integer',
        'show_homepage' => 'integer',
        'serial' => 'integer',
        'country_state_id' => 'integer',
        'country_id' => 'integer',
    ];
}
