<?php

namespace App\Actions\Post;

use App\Models\Post;
use App\DTOs\createPostData;

class updatePostAction
{
    public function execute(Post $post, CreatePostData $data): Post
    {
        $post->update([
            'body' => $data->body,
            'image' => $data->image ? $data->image->store('posts', 'public') : $post->image,
        ]);

        return $post->fresh();
    }
}
