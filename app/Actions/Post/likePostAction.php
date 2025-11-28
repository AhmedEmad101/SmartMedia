<?php

namespace App\Actions\Post;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;

final class likePostAction
{
    public function execute(User $user, Post $post)
    {
        $existing = Like::where('user_id', $user->id)
            ->where('post_id', $post->id)
            ->first();

        if ($existing) {
            $existing->delete();
            return false;
        }
        Like::create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);
        return true;
    }
}
