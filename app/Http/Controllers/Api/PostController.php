<?php

namespace App\Http\Controllers\Api;

use App\Actions\Post\createPostAction;
use App\Actions\Post\deletePostAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DTOs\createPostData;
use App\Http\Requests\createPostRequest;
use App\Actions\Post\getPostsAction;
use App\Actions\Post\updatePostAction;
use App\DTOs\getPostsData;
use App\Http\Resources\PostResource;
use App\Actions\Image\storeImageAction;
use App\Traits\ApiResponseTrait;
use App\Models\Post;
class PostController extends Controller
{
     use ApiResponseTrait;
     public function index(getPostsAction $action)
    {
        try {
            $data = getPostsData::fromRequest(request());
            $posts = $action->execute($data);
            $resourceCollection = PostResource::collection($posts);
            $resourceArray = $resourceCollection->response()->getData(true);
               return $this->successResponse($resourceArray, 'Posts retrieved successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
   public function store(createPostRequest $request, CreatePostAction $createPostAction, storeImageAction $storeImage)
{
   
        try {
            $validated = $request->validated();
            $dto = createPostData::fromRequest($request);
            $post = $createPostAction->execute(auth()->user(), (array) $dto);

            if ($request->hasFile('image')) {
                $path = $storeImage->execute($request->file('image'), 'posts');
                if ($path) {
                    $post->image = $path;
                    $post->save();
                }
            }
            $resource = new PostResource($post);
            $resourceArray = $resource->response()->getData(true);
             return $this->successResponse($resourceArray, 'Post created successfully', 201);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
}
 public function update(createPostRequest $request, Post $post, updatePostAction $updatePostAction, storeImageAction $storeImage)
    {
        try {
            $validated = $request->validated();
            $dto = createPostData::fromRequest($request);
            if ($request->hasFile('image')) {
                $path = $storeImage->execute($request->file('image'), 'posts');
                if ($path) {
                    $dtoArray = (array) $dto;
                    $dtoArray['image'] = $path;
                    $dto = (object) $dtoArray; 
                }
            }
            $updatedPost = $updatePostAction->execute($post, $dto);
            $resource = new PostResource($updatedPost);
            $resourceArray = $resource->response()->getData(true);

            return $this->successResponse($resourceArray, 'Post updated successfully');
        } catch (\Throwable $e) {
            \Log::error('Post update error: '.$e->getMessage());
            return $this->errorResponse('Failed to update post', 500);
        }
    }

    public function destroy($id, deletePostAction $deletePostAction)
    {
        try {
            $deleted = $deletePostAction->execute($id, auth()->id());

            if (! $deleted) {
                return $this->errorResponse('Post not found or unauthorized', 404);
            }

            return $this->successResponse(null, 'Post deleted successfully');
        } catch (\Throwable $e) {
            \Log::error('Post delete error: '.$e->getMessage());
            return $this->errorResponse('Failed to delete post', 500);
        }
    }
}
