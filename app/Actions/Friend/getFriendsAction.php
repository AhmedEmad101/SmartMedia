<?php

namespace App\Actions\Friend;

use App\Models\Friend;
use App\Http\Resources\FriendResource;
final class getFriendsAction
{
    public static function execute($user_id)
    {  $friends = Friend::with('friend')
            ->where('user_id', $user_id)
            ->get();
        if($friends->count() > 0){
        return FriendResource::collection($friends);     
        }
        return null;
    }
    }
