<?php

namespace App\Actions\Friend;

use App\Actions\deleteFriendRequestAction;
use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\User;

class addFriendAction
{
    public function execute(User $user, $data)
    {
        $friend_request = FriendRequest::query()
            ->where('sender_id', $user->id)->where('reciever_id', $data->reciever_id)->first();
        if ($friend_request && $friend_request->status == 'accepted') {
            $sender_friend = Friend::create(
                ['user_id' => $user->id,
                    'friend_id' => $data->reciever_id,
                ]
            );
            $reciever = Friend::create(
                ['user_id' => $data->reciever_id,
                    'friend_id' => $user->id,
                ]
            );

            return;
        } elseif ($friend_request && $friend_request->status == 'declined') {
            deleteFriendRequestAction::execute($friend_request);
        }

    }
}
