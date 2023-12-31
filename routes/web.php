<?php

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;

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
    // return view('welcome');
    return redirect('/dashboard');
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

Route::resource('posts', PostController::class)
    ->middleware(['auth']);

// BUSCADOR
Route::get('places.search', 'App\Http\Controllers\PlaceController@search')->name('places.search');
Route::get('posts.search', 'App\Http\Controllers\PostController@search')->name('posts.search');

// FAVORITOS
Route::post('/places/{place}/favorites', 'App\Http\Controllers\PlaceController@favorite')
    ->name('places.favorites')
    ->middleware('can:create,place');

Route::delete('/places/{place}/favorites', 'App\Http\Controllers\PlaceController@unfavorite')->name('places.unfavorites');

// MULTI-LENGUAJE
Route::get('/language/{locale}', [LanguageController::class, 'language'])->name('language');

// ME GUSTA
Route::post('/posts/{post}/likes', 'App\Http\Controllers\PostController@like')->name('posts.likes');
Route::delete('/posts/{post}/likes', 'App\Http\Controllers\PostController@unlike')->name('posts.unlike');

Route::get('/about-us', function () {
    return view('about.index');
})->middleware(['auth', 'verified'])->name('about');

Route::get('/about-cristian', function () {
    return view('about.cristian.index');
})->middleware(['auth', 'verified'])->name('about-cristian');

Route::get('/about-gerard', function () {
    return view('about.gerard.index');
})->middleware(['auth', 'verified'])->name('about-gerard');

require __DIR__.'/auth.php';
