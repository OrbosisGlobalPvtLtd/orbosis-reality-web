<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertySlider extends Model
{
    use HasFactory;

    protected $appends = ['image_url'];

    public function getImageAttribute($value)
    {
        if (!$value) {
            $setting = \App\Models\Setting::first();
            return $setting && $setting->default_placeholder ? url($setting->default_placeholder) : '';
        }
        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            return $value;
        }
        return url($value);
    }

    public function getImageUrlAttribute()
    {
        return $this->image;
    }

    protected $casts =  [
        'id' => 'integer',
        'property_id' => 'integer',
    ];
}
