<?php

namespace App\Http\Controllers\api;

use App\Actions\Image\storeImageAction;
use App\Actions\User\getProfileAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use ApiResponseTrait;

    public function profile()
    {
        $result = getProfileAction::execute(auth()->user()->id);

        return $result ? $this->successResponse($result) : $this->errorResponse('not found');
    }

    public function updateAvatar(UpdateAvatarRequest $request, storeImageAction $storeImage)
    {
        $validated_request = $request->validated();
        $user = auth()->user();
        $path = $storeImage->execute($validated_request['avatar'], 'avatars');
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        $user->update(['avatar' => $path]);

        return $this->successResponse('Avatar updated');
    }
}
