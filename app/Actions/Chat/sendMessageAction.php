<?php

namespace App\Actions\Chat;

use App\Models\Chat;
use App\Models\User;
use App\Events\ChatCreated;
class sendMessageAction
{
    public static function execute(int $senderId, int $receiverId, string $message)
    {
        $chat = Chat::create([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'message' => $message,
        ]);

        event(new ChatCreated($chat));

        return $chat;
    }
}
