<?php

namespace App\Models;

use App\Traits\TraitsForTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogCategory extends Model
{
    use HasFactory, TraitsForTranslation;


    protected $appends = ['totalBlog'];

    public function blogs(){
        return $this->hasMany(Blog::class)->where('status',1);
    }

    public function getTotalBlogAttribute()
    {
        return $this->blogs()->count();
    }

    protected $casts =  [
        'id' => 'integer',
        'status' => 'integer',
        'totalBlog' => 'integer',
    ];

}
