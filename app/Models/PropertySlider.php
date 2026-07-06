<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertySlider extends Model
{
    use HasFactory;

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            $setting = \App\Models\Setting::first();
            return $setting->default_placeholder ? url($setting->default_placeholder) : null;
        }
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }
        return url($this->image);
    }

    protected $casts =  [
        'id' => 'integer',
        'property_id' => 'integer',
    ];
}
