<?php

namespace App\Actions\Friend\Request;

use App\Models\FriendRequest;

final class deleteFriendRequestAction
{
    public static function execute($user_id, $other_user_id)
    {
        $request = FriendRequest::query()
            ->where(function($q) use ($user_id, $other_user_id) {
                $q->where('sender_id', $user_id)
                  ->where('receiver_id', $other_user_id);
            })
            ->orWhere(function($q) use ($user_id, $other_user_id) {
                $q->where('receiver_id', $user_id)
                  ->where('sender_id', $other_user_id);
            })
            ->first();

        if (! $request) {
            return false;
        }

        $request->delete();
        return true;

    }
}
