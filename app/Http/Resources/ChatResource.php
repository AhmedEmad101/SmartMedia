<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => $this->message,
            'sender_id' => $this->sender_id,
            'receiver_id' => $this->receiver_id,
            'sender_name' => $this->sender->name,
            'receiver_name' => $this->receiver->name,
            'sender_avatar' => $this->sender->avatar,
            'receiver_avatar' => $this->receiver->avatar,
        ];
    }
}
