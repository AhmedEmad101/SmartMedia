<?php

namespace App\Actions\Post;

use App\DTOs\getPostsData;
use App\Models\Post;

final class GetPostsAction
{
    public function execute(getPostsData $data)
    {
        $query = Post::query()->with('user');

        return $query
            ->latest()
            ->paginate($data->limit, ['*'], 'page', $data->page);
    }
}
