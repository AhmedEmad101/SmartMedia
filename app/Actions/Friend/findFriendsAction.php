<?php

namespace App\Actions\Friend;

use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\User;

class findFriendsAction
{
    public static function execute($user)
    {
        $friendIds = Friend::where('user_id', $user->id)
            ->pluck('friend_id')
            ->toArray();
        $sentRequests = FriendRequest::where('sender_id', $user->id)
            ->pluck('receiver_id')
            ->toArray();

        $receivedRequests = FriendRequest::where('receiver_id', $user->id)
            ->pluck('sender_id')
            ->toArray();

        $exclude = array_unique(array_merge(
            [$user->id],
            $friendIds,
            $sentRequests,
            $receivedRequests
        ));

        return User::whereNotIn('id', $exclude)
            ->select('id', 'name', 'avatar')
            ->get();
    }
}
