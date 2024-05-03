<?php

use App\Http\Controllers\Theme\ContentController;
use App\Http\Controllers\GoogleApiAuthController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Http\Controllers\Google\FormsController;
use App\Models\GoogleForm;

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



Route::prefix('/')->name('theme.')->group(function () {

    Route::get('/', Home::class)->name('home');

    Route::get('tblog', function () {
        return view('theme.pages.blog');
    });
    Route::get('/post-single', fn () => view('theme.pages.post'));
});


Route::prefix('/ajax')->name('ajax.')->group(function () {
    Route::get('/like_post/{post:slug}', [App\Http\Controllers\Theme\ContentController::class, 'like_post'])->name('like_post');
    Route::get('/dislike-post/{post:slug}', [App\Http\Controllers\Theme\ContentController::class, 'dislike_post'])->name('dislike_post');
});


Route::get('/{id}/posts', [App\Http\Controllers\Theme\ContentController::class, 'author_posts'])->name('author_posts');
Route::get('/test', [App\Http\Controllers\Theme\ContentController::class, 'test']);
Route::get('/forms', [ContentController::class, 'connect']);
Route::get('/token', [ContentController::class, 'set_token'])->name('token');
Route::get('/ft', [ContentController::class, 'fetch_forms']);



Route::prefix('google/')->name('google.')->group(function () {
    Route::get('authnticate', [GoogleApiAuthController::class, 'redirectToAuthnitcateUrl'])->name('redirect');
    Route::get('callback', [GoogleApiAuthController::class, 'callback'])->name('callback');
    Route::get('refresh_token', [GoogleApiAuthController::class, 'refreshToken']);
    Route::get('fetch_forms' , [FormsController::class , 'fetchForms'])->name('fetchForms');
});
