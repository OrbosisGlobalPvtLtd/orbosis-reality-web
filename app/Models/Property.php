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

    protected $appends = ['totalRating', 'ratingAvarage'];

    public function getTotalRatingAttribute()
    {
        return $this->reviews()->count();
    }

    public function getRatingAvarageAttribute()
    {
        return $this->reviews()->avg('rating');
    }

    protected $casts =  [
        'id' => 'integer',
        'agent_id' => 'integer',
        'property_type_id' => 'integer',
        'city_id' => 'integer',
        'serial' => 'integer',
        'totalRating' => 'integer',
        'ratingAvarage' => 'double',

    ];






}
