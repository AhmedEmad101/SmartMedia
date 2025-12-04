<?php

namespace App\Actions\Friend;

use App\Actions\Friend\Request\deleteFriendRequestAction;
use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\User;

class addFriendAction
{
    public function execute(User $user, $data)
    {
        $friend_request = FriendRequest::query()
            ->where('sender_id', $data->sender_id)->where('receiver_id', $user->id)
            ->where('status', 'pending')
            ->first();
        if ($friend_request && $data->status == 'accepted') {
            $sender_friend = Friend::create(
                ['user_id' => $user->id,
                    'friend_id' => $data->sender_id,
                ]
            );
            $reciever = Friend::create(
                ['user_id' => $data->sender_id,
                    'friend_id' => $user->id,
                ]
            );
            deleteFriendRequestAction::execute($user->id, $data->sender_id);

            return 1;
        } elseif ($friend_request && $friend_request->status == 'declined') {
            deleteFriendRequestAction::execute($user->id, $data->sender_id);

            return 0;
        }

    }
}
