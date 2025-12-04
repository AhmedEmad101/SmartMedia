<?php

namespace App\DTOs;

final class addFriendData
{
    public function __construct(
        public int $sender_id,
        public string $status
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            $request->input('sender_id'),
            $request->input('status')
        );
    }
}
