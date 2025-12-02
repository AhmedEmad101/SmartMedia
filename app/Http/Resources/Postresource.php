<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Postresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'body' => $this->body,
            'image' => $this->image ? asset('storage/'.$this->image) : null,
            'created_at' => $this->created_at,
            'likes_count' =>$this->likes->count(),
        'likers' => $this->likes->map(function ($like) {
            return [
                'id' => $like->user->id,
                'name' => $like->user->name,
                'avatar' => $like->user->avatar
                    ? asset('storage/'.$like->user->avatar)
                    : asset('default-avatar.png')
            ];
        }),
           'comments_count' => $this->comments->count(),

        'comments' => $this->comments->map(function ($comment) {
            return [
                'id' => $comment->id,
                'body' => $comment->body,
                'created_at' => $comment->created_at,

                'user' => [
                    'id' => $comment->user->id,
                    'name' => $comment->user->name,
                    'avatar' => $comment->user->avatar
                        ? asset('storage/'.$comment->user->avatar)
                        : asset('default-avatar.png'),
                ],
            ];
        }),
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'avatar'=>$this->user->avatar 
                          ? asset('storage/avatar' . $this->user->avatar) 
                          : asset('storage/avatars/personimage.jpg')
            ],
        ];
    }
}
