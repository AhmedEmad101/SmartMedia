<?php
namespace App\Actions\Friend\Request;
use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\User;

class sendFriendRequestAction
{
    public function execute(User $user, $data)
    {
        $friend = Friend::query()
        ->where('user_id',$user->id)
        ->where('friend_id',$data->receiver_id)
        ->first();
        if(!$friend){
        return FriendRequest::create(
            ['sender_id' => $user->id,
                'receiver_id' => $data->receiver_id,
            ]
        );
    }
    return 0;
    }
}
