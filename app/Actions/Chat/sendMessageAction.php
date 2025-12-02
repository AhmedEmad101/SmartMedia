<?php

namespace App\Actions\Chat;

use App\Models\Chat;
use App\Models\User;

class sendMessageAction
{
    public static function execute(array $data)
    {
        // Validate receiver exists
        $receiver = User::find($data['receiver_id']);
        if (!$receiver) {
            return response()->json(['message' => 'Receiver not found'], 404);
        }

        // Create the message
        $message = Chat::create([
            'sender_id'   => auth()->id(),
            'receiver_id' => $data['receiver_id'],
            'message'     => $data['message'] ?? null,
            'attachment'  => $data['attachment'] ?? null,
        ]);

        return $message;
    }
}
