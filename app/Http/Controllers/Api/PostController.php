<?php

namespace App\Http\Controllers\Api;

use App\Actions\Post\createPostAction;
use App\Actions\Post\deletePostAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DTOs\createPostData;
use App\Http\Requests\createPostRequest;
class PostController extends Controller
{
   public function store(createPostRequest $request, CreatePostAction $createPostAction)
{
    $validated = $request->validated();
    $dto = createPostData::fromRequest($request);
    $post = $createPostAction->execute(auth()->user(), (array) $dto);

    return response()->json($post, 201);
}
public function update(createPostRequest $request, Post $post, updatePostAction $updatePostAction)
{
    $validated = $request->validate([
        'body' => 'required|string',
        'image' => 'nullable|image|max:2048',
    ]);

    $dto = createPostData::fromRequest($request);

    $updatedPost = $updatePostAction->execute($post, $dto);

    return response()->json($updatedPost);
}
}
