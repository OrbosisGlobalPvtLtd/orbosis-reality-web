<?php

namespace Modules\SupportTicket\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\SupportTicket\Entities\TicketMessage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportTicket extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\SupportTicket\Database\factories\SupportTicketFactory::new();
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id')->select('id','name','email','image','phone','address');
    }

    public function unSeenUserMessage(){
        return $this->hasMany(TicketMessage::class)->where('seen_by_user', 'no');
    }

    protected $appends = ['unseen_message'];

    protected $hidden = ['unSeenUserMessage'];

    public function getUnseenMessageAttribute()
    {
        return $this->unSeenUserMessage->count();
    }

}
