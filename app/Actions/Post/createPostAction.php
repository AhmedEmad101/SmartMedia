<?php

namespace App\Actions\Post;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;

class createPostAction
{
    /**
     * Handle the creation of a post.
     *
     * @param  int  $userId
     * @param  string  $body
     * @param  UploadedFile|null  $image
     */
    public function execute(User $user, array $data): Post
    {
        return Post::query()->create([
            'user_id' => $user->id,
            'body' => $data['body'],
            'image' => $data['image'] ?? null,
        ]);
    }
}
