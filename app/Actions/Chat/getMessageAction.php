<?php

namespace App\Actions\Chat;

use App\Models\Chat;

class getMessageAction
{
    public static function execute()
    {
        $messages = Chat::query()
            ->where('sender_id', auth()->id())
            ->orwhere('receiver_id', auth()->id())
            ->orderBy('created_at', 'asc')
            ->get();
        if ($messages) {
            return $messages;
        }

        return null;
    }
}
