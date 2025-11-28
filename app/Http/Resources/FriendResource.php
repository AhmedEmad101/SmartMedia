<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FriendResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'friend_id' => $this->friend_id,
            'friend' => [
                'id'     => $this->friend?->id,
                'name'   => $this->friend?->name,
                'avatar' => $this->friend?->avatar 
                                ? asset('storage/' . $this->friend->avatar)
                                : asset('default-avatar.png'),
            ]
        ];
    }
}
