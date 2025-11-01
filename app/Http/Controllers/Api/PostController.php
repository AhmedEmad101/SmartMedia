<?php

namespace App\Http\Controllers\Api;

use App\Actions\Post\createPostAction;
use App\Actions\Post\deletePostAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DTOs\createPostData;
use App\Http\Requests\createPostRequest;
use App\Actions\Post\getPostsAction;
use App\DTOs\getPostsData;
class PostController extends Controller
{
     public function index(getPostsAction $action)
    {
        $data = GetPostsData::fromRequest(request());
        $posts = $action->execute($data);
        return response()->json($posts);
    }
   public function store(createPostRequest $request, CreatePostAction $createPostAction)
{
    $validated = $request->validated();
    $dto = createPostData::fromRequest($request);
    $post = $createPostAction->execute(auth()->user(), (array) $dto);

    return response()->json($post, 201);
}
public function update(createPostRequest $request, Post $post, updatePostAction $updatePostAction)
{
    $validated = $request->validated();
    $dto = createPostData::fromRequest($request);
    $updatedPost = $updatePostAction->execute($post, $dto);
    return response()->json($updatedPost);
}
}
