<?php

namespace App\Models;

use App\Traits\TraitsForTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdditionalInformation extends Model
{
    use HasFactory, TraitsForTranslation;

    protected $casts =  [
        'id' => 'integer',
        'property_id' => 'integer',
    ];


}
