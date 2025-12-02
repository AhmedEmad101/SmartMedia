<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Actions\Chat\sendMessageAction;
use App\Actions\Chat\getMessageAction;
use App\Actions\Chat\markAsReadAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChatSendRequest;
use App\Http\Resources\ChatResource;
class ChatController extends Controller
{use ApiResponseTrait;
  public function send(ChatSendRequest $request)
    {
        $data = $request->validated();
        $chat = sendMessageAction::execute(
        auth()->id(),
        $data['receiver_id'],
        $data['message']
    );
        return $this->successResponse($chat, 201);
    }

    public function fetch()
    {
      $chats = getMessageAction::execute();
      if($chats){
      return $this->successResponse(ChatResource::collection($chats));
      }
        return $this->errorResponse('no chats founded',404);
    }

    public function markRead($sender_id)
    {
        $read = markAsReadAction::execute($sender_id);
        if($read){
         return $this->successResponse(['message' => 'Messages marked as read'], 200);
        }
        return $this->errorResponse('message not found',404);
    }   
}
