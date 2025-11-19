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
        if ($friend) {
            $friend->delete();

            return 1;
        }

        return 0;
    }
}
