<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Friend extends Model
{ use HasFactory;
    protected $fillable = ['user_id', 'friend_id'];
    //***************************relationships*********************//
     public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function friend()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }
}
