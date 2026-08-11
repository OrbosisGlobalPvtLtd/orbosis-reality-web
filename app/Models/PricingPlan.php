<?php

namespace App\Models;

use App\Traits\TraitsForTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PricingPlan extends Model{
    use HasFactory, TraitsForTranslation;

    protected $fillable = [
        'plan_type', 'plan_name', 'plan_price', 'expired_date', 'number_of_property',
        'featured_property_qty', 'top_property_qty', 'urgent_property_qty', 'serial',
        'status', 'is_featured_badge_allowed'
    ];

    protected $casts =  [
        'id' => 'integer',
        'plan_price' => 'double',
        'number_of_property' => 'integer',
        'featured_property_qty' => 'integer',
        'top_property_qty' => 'integer',
        'urgent_property_qty' => 'integer',
        'serial' => 'integer',
        'is_featured_badge_allowed' => 'integer',
    ];
}
