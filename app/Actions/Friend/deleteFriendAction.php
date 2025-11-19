<?php

namespace App\Actions\Friend;

use App\Models\Friend;

final class deleteFriendAction
{
    public function execute($friend_id, $user_id)
    {
        $friend = Friend::query()
            ->where('user_id', $user_id)
            ->where('friend_id', $friend_id)
            ->first();
        $user = Friend::query()
          ->where('user_id', $friend_id)
            ->where('friend_id', $user_id)
            ->first();
        if ($friend && $user) {
            $friend->delete();
            $user->delete();
            return 1;
        }

        return 0;
    }
}
