<?php

namespace App\DTOs;

use Illuminate\Http\UploadedFile;

final class CreatePostData
{
    public function __construct(
        public string $body,
        public ?UploadedFile $image = null,
    ) {}
     public static function fromRequest($request): self
    {
        return new self(
            body: $request->input('body'),
            image: $request->input('image')
        );
    }
}
