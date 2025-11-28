<?php

namespace App\Http\Controllers\api;
use App\Actions\Friend\getFriendsAction;
use App\Actions\Friend\addFriendAction;
use App\Actions\Friend\deleteFriendAction;
use App\Actions\Friend\Request\sendFriendRequestAction;
use App\Actions\Friend\Request\deleteFriendRequestAction;
use App\DTOs\addFriendData;
use App\DTOs\addFriendRequestData;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use App\Models\FriendRequest;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    use ApiResponseTrait;
    public function get_friends(Request $request , getFriendsAction $action)
    {
        $friends = $action->execute(auth()->user()->id);
        if($friends)
        {
         return $this->successResponse($friends,'Friend has been retrieved successfully');   
        }
         return $this->errorResponse('Failed to fetch friends', 400);
    }
    public function send_friend_request(Request $request, sendFriendRequestAction $add_friend_request_action)
    {
        $friend_data = addFriendRequestData::fromRequest($request);
       $result = $add_friend_request_action->execute(auth()->user(), $friend_data);
    if (!$result) {
        return $this->errorResponse('You are already friends with this user', 400);
    }

    return $this->successResponse('Friend request has been sent successfully');
    }
     public function delete_friend_request(Request $request,deleteFriendRequestAction $action)
    {    $success = $action->execute(
        user_id: auth()->id(),
        other_user_id: $request->user_id
    );

    if (! $success) {
        return $this->errorResponse('Friend request not found', 404);
    }

    return $this->successResponse('Friend request deleted successfully');

   
    }

    public function add_friend(Request $request, addFriendAction $add_friend_action)
    {
        $friend_data = addFriendData::fromRequest($request);
        $result = $add_friend_action->execute(auth()->user(), $friend_data);
          if (!$result) {
        return $this->errorResponse('invalid request', 400);
    }
        return $this->successResponse('Friend has been added successfully');
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
