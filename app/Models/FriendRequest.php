<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class FriendRequest extends Model
{
    protected $fillable = ['sender_id', 'receiver_id'];
     //***************************relationships*********************//
    public function sender()
{
    return $this->belongsTo(User::class, 'sender_id');
}
}
