<?php

namespace App\Actions\Chat;

use App\Events\ChatCreated;
use App\Models\Chat;

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
