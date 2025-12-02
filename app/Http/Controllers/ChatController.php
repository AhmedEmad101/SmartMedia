<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Actions\Chat\sendMessageAction;
use App\Actions\Chat\getMessagesAction;
use App\Actions\Chat\markAsReadAction;
class ChatController extends Controller
{use ApiResponseTrait;
  public function send(ChatSendRequest $request)
    {
        $data = $request->validated();
        $message = sendMessageAction::execute($data);
        return $this->successResponse($message, 201);
    }

    public function fetch($receiver_id)
    {
      return $this->successResponse(getMessagesAction::execute($receiver_id),200);
    }

    public function markRead($sender_id)
    {
        markAsReadAction::execute($sender_id);
         return $this->successResponse(['message' => 'Messages marked as read'], 201);
    }   
}
