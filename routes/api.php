<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\TokenController;
use App\Http\Controllers\Api\PlaceController;

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


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('places', PlaceController::class);
    Route::post('places/{id}/favorite', [PlaceController::class, 'favorite']);
    Route::delete('places/{id}/unfavorite', [PlaceController::class, 'unfavorite']);
});