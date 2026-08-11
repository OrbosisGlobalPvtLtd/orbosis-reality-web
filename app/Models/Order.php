<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->select('id', 'name', 'email', 'image', 'phone', 'address');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id')->select('id', 'name', 'email', 'image', 'phone', 'address');
    }

    public function pricing_plan()
    {
        return $this->belongsTo(PricingPlan::class, 'pricing_plan_id');
    }

    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'agent_id' => 'integer',
        'pricing_plan_id' => 'integer',
        'max_agent_add' => 'integer',
    ];
}
