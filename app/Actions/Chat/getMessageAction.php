<?php

namespace App\Actions\Chat;

use App\Models\Chat;

class getMessagesAction
{
    public static function execute(int $receiver_id)
    {
        return Chat::where(function ($q) use ($receiver_id) {
            $q->where('sender_id', auth()->id())
              ->where('receiver_id', $receiver_id);
        })
        ->orWhere(function ($q) use ($receiver_id) {
            $q->where('sender_id', $receiver_id)
              ->where('receiver_id', auth()->id());
        })
        ->orderBy('created_at', 'asc')
        ->get();
    }
}
