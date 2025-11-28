<?php

namespace App\Actions\Friend\Request;

use App\Models\FriendRequest;

final class getFriendRequestsAction
{
    public static function execute($userId)
    {
        $requests = FriendRequest::with('sender')
            ->where('receiver_id', $userId)
            ->where('status', 'pending')
            ->get();
if($requests->count()>0){
        return $requests;
}
return null;
    }
}
