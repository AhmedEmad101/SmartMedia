<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FriendController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'login_execption'])->name('login');
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index']);
        Route::post('/', [PostController::class, 'store']);
        Route::put('/{post}', [PostController::class, 'update']);
        Route::post('/{post}/like', [PostController::class, 'like']);
        Route::delete('/{post}', [PostController::class, 'destroy']);
    });
    Route::prefix('friends')->group(function () {
        Route::get('/', [FriendController::class, 'get_friends']);
        Route::get('/requests', [FriendController::class, 'get_friend_requests']);
        Route::post('/send-request', [FriendController::class, 'send_friend_request']);
        Route::delete('/delete-request', [FriendController::class, 'delete_friend_request']);
        Route::post('/add', [FriendController::class, 'add_friend']);
        Route::delete('/{friend}', [FriendController::class, 'delete_friend']);
    });
     Route::prefix('user')->group(function () {
         Route::get('profile', [UserController::class, 'profile']);
         Route::post('avatar', [UserController::class, 'updateAvatar']);
        });

    Route::post('/logout', [AuthController::class, 'logout']);
});
 