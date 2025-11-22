<?php
namespace App\Actions\User;
use App\Models\User;
use App\Http\Resources\UserResource;
class getProfileAction
{
public static function execute($id)
{
    $user = User::find($id);
    if($user){
    return new UserResource($user);
    }
    return null;
}
}