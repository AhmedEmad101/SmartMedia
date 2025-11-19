<?php

namespace App\DTOs;

final class addFriendData
{
    public function __construct(
        public int $friend_id,
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            $request->input('reciever_id')
        );
    }
}
