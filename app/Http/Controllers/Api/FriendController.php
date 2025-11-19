<?php

namespace App\Http\Controllers\api;

use App\Actions\Friend\addFriendAction;
use App\Actions\Friend\deleteFriendAction;
use App\Actions\Friend\sendFriendRequestAction;
use App\DTOs\addFriendData;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    use ApiResponseTrait;

    public function send_friend_request(Request $request, sendFriendRequestAction $add_friend_request_action)
    {
        $friend_data = addFriendData::fromRequest($request);
        $add_friend_request_action->execute(auth()->user(), $friend_data);

        return $this->successResponse('Friend request has been sent successfully');
    }

    public function add_friend(Request $request, addFriendAction $add_friend_action)
    {
        $friend_data = addFriendData::fromRequest($request);
        $add_friend_action->execute(auth()->user(), $friend_data);

        return $this->successResponse('Friend added successfully');
    }

    public function delete_friend($friend_id, deleteFriendAction $delete_friend_action)
    {
        $result = $delete_friend_action->execute($friend_id, auth()->user());
        if ($result) {
            return $this->successResponse('Friend has been deleted successfully');
        }

        return $this->errorResponse('Failed to delete the friend');
    }
}
