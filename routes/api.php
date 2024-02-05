<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\TokenController;
use App\Http\Controllers\Api\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('files', FileController::class);
Route::post('files/{file}', [FileController::class, 'update_workaround']);

Route::post('/login', [TokenController::class, 'login']);
Route::post('/register', [TokenController::class, 'register']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [TokenController::class, 'user']);
    Route::post('/logout', [TokenController::class, 'logout']);
});

Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{id}', [PostController::class, 'show']);
Route::post('/posts/{post}/likes', [PostController::class, 'like']);
Route::delete('/posts/{post}/likes', [PostController::class, 'unlike']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('posts', [PostController::class, 'store']);
    Route::post('posts/{id}', [PostController::class, 'update_workaround']);
    Route::delete('posts/{id}', [PostController::class, 'destroy']);
});