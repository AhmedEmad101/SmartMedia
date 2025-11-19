<?php

namespace App\DTOs;

final class addFriendRequestData
{
    public function __construct(
        public int $receiver_id	
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            $request->input('receiver_id')
        );
    }
}
