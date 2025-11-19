<?php

namespace App\Actions\Friend;

use App\Models\FriendRequest;

final class deleteFriendRequestAction
{
    public function execute(FriendRequest $friend_request)
    {
        if ($friend_request) {
            $friend_request->delete();
        }

    }
}
