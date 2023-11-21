<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PostController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function (Request $request) {
    $message = 'Loading welcome page';
    Log::info($message);
    $request->session()->flash('info', $message);
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('mail/test', [MailController::class, 'test']);

Route::resource('files', FileController::class)
    ->middleware(['auth']);

Route::resource('places', PlaceController::class)
    ->middleware(['auth']);

Route::get('places.search', 'App\Http\Controllers\PlaceController@search')->name('places.search');

Route::resource('posts', PostController::class)
    ->middleware(['auth']);

Route::get('posts.search', 'App\Http\Controllers\PostController@search')->name('posts.search');

Route::post('/places/{place}/favorites', 'App\Http\Controllers\PlaceController@favorite')->name('places.favorites');
Route::delete('/places/{place}/favorites', 'App\Http\Controllers\PlaceController@unfavorite')->name('places.unfavorites');

Route::post('/posts/{post}/likes', 'App\Http\Controllers\PostController@like')->name('posts.likes');
Route::delete('/posts/{post}/likes', 'App\Http\Controllers\PostController@unlike')->name('posts.unlike');


require __DIR__.'/auth.php';
