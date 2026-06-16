<?php

namespace App\Models;

use App\Traits\TraitsForTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory, TraitsForTranslation;

    public function category(){
        return $this->belongsTo(BlogCategory::class,'blog_category_id');
    }

    public function admin(){
        return $this->belongsTo(Admin::class)->select('id','name');
    }

    public function comments(){
        return $this->hasMany(BlogComment::class);
    }

    public function activeComments(){
        return $this->hasMany(BlogComment::class)->where('status',1);
    }

    protected $appends = ['totalComment'];



    public function getTotalCommentAttribute()
    {
        return $this->activeComments()->count();
    }

    protected $casts =  [
        'id' => 'integer',
        'totalComment' => 'integer',
        'status' => 'integer',
        'admin_id' => 'integer',
    ];

}
