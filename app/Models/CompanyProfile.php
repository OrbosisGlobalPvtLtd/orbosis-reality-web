<?php

namespace App\Models;

use Modules\Kyc\Entities\KycType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'tag_line',
        'about_us',
        'email',
        'phone',
        'image',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'is_approved',
        'address',
        'kyc_id',
        'file',
        'message',
        'city_id',
        'state_id',
        'rera_number',
        'gst_number',
        'id_proof',
    ];

    public function kyc(){
        return $this->belongsTo(KycType::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function state(){
        return $this->belongsTo(CountryStateModal::class, 'state_id');
    }
}
