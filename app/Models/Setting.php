<?php

namespace App\Models;

use App\Traits\TraitsForTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory , TraitsForTranslation;

    public function getLogoAttribute($value)
    {
        return $value ?: 'uploads/website-images/logo-2026-01-10-05-02-59-8516.png';
    }

    public function getFooterLogoAttribute($value)
    {
        return $value ?: ($this->attributes['logo'] ?? 'uploads/website-images/logo-2026-01-10-05-02-59-8516.png');
    }

    public function getFaviconAttribute($value)
    {
        return $value ?: 'uploads/website-images/favicon-2026-03-20-06-06-43-7555.png';
    }

    public function getLoginPageLogoAttribute($value)
    {
        return $value ?: ($this->attributes['logo'] ?? 'uploads/website-images/logo-2026-01-10-05-02-59-8516.png');
    }
}
