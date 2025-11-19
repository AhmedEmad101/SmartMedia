<?php

namespace App\Actions\Friend;

use App\Models\FriendRequest;
use App\Models\User;

class sendFriendRequestAction
{
    public function execute(User $user, $data)
    {
        return FriendRequest::create(
            ['sender_id' => $user->id,
                'reciever_id' => $data->friend_id,
            ]
        );
    }
}
