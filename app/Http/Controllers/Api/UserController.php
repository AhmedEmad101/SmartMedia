<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Actions\User\getProfileAction;
use App\Traits\ApiResponseTrait;
use App\Actions\Image\storeImageAction;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Support\Facades\Storage;
class UserController extends Controller
{use ApiResponseTrait;
   public function profile()
   { $result = getProfileAction::execute(auth()->user()->id);
    return $result?$this->successResponse($result):$this->errorResponse('not found');;
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
