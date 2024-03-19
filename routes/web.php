<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
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

Route::get('/test', [App\Http\Controllers\Theme\ContentController::class, 'test']);
