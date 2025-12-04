<?php

namespace App\Actions\User;

use App\Http\Resources\UserResource;
use App\Models\User;

class getProfileAction
{
    public static function execute($id)
    {
        $user = User::find($id);
        if ($user) {
            return new UserResource($user);
        }

        return null;
    }
}
