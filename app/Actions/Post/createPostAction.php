<?php

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\DTOs\createPostData;
use App\Models\User;
class createPostAction
{
    /**
     * Handle the creation of a post.
     *
     * @param  int  $userId
     * @param  string  $body
     * @param  UploadedFile|null  $image
     * @return \App\Models\Post
     */
     public function execute(User $user, array $data): Post
    {
        return Post::create([
            'user_id' => $user->id,
            'body' => $data['body'],
            'image' => $data['image'] ?? null,
        ]);
    }
}
