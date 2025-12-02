<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class FriendRequest extends Model
{use HasFactory;
    protected $fillable = ['sender_id', 'receiver_id'];
     //***************************relationships*********************//
    public function sender()
{
    return $this->belongsTo(User::class, 'sender_id');
}
}
