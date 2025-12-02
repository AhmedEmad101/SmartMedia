<?php

namespace App\Events;
use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $chat;
    public function __construct(Chat $chat)
    {
         $this->chat = $chat;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.' . $this->chat->receiver_id),
        ];
    }
     public function broadcastWith()
    {
        return [
            'id' => $this->chat->id,
            'sender_id' => $this->chat->sender_id,
            'receiver_id' => $this->chat->receiver_id,
            'message' => $this->chat->message,
            'created_at' => $this->chat->created_at->toDateTimeString(),
        ];
    }
}
