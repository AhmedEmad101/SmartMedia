<?php

namespace App\Actions\Post;

use App\Models\Post;

class deletePostAction
{
    public function execute(int $postId, int $userId): bool
    {
        $post = Post::where('id', $postId)
                    ->where('user_id', $userId)
                    ->first();

        if (! $post) {
            return false;
        }

        $post->delete();

        return true;
    }
}
