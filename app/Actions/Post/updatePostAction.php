<?php

namespace App\Actions\Post;

use App\DTOs\createPostData;
use App\Models\Post;

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
