<?php

use App\Http\Controllers\Api\{V1\BlogController,
    V1\TagController,
    LoginController,
    RegisterController,
    LogOutController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::controller(BlogController::class)->group(function () {
        Route::get('/blogs', 'index');
        Route::post('/blog/store', 'store');
        Route::post('/blog/{blogId}/attach/tag/{tagId}', 'attachTag');
        Route::post('/blog/{blogId}/detach/tag/{tagId}', 'detachTag');
    });

    Route::controller(TagController::class)->group(function () {
        Route::get('/tags', 'index');
        Route::post('/tag/store', 'store');
    });
});

Route::post('/login', LoginController::class);
Route::post('/register', RegisterController::class);
Route::post('/logout', LogOutController::class)->middleware('auth:sanctum');
