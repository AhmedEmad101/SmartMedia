<?php

namespace App\Actions\Chat;

use App\Models\Chat;

class markAsReadAction
{
    public static function execute(int $sender_id)
    {
        return Chat::where('sender_id', $sender_id)
            ->where('receiver_id', auth()->id())
            ->update(['is_read' => true]);
    }
}
