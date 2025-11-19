<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FriendController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index']);
        Route::post('/', [PostController::class, 'store']);
        Route::put('/{post}', [PostController::class, 'update']);
        Route::post('/{post}/like', [PostController::class, 'like']);
        Route::delete('/{post}', [PostController::class, 'destroy']);
    });
    Route::prefix('friends')->group(function () {
        Route::get('/', [FriendController::class, 'index']);
        Route::post('/add', [FriendController::class, 'add_friend']);
        Route::delete('/{friend}', [FriendController::class, 'delete_friend']);
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});
