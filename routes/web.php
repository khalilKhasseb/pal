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

    Route::get('/',Home::class)->name('home');

    Route::get('tblog', function () {
        return view('theme.pages.blog');
    });
    Route::get('/post-single', fn () => view('theme.pages.post'));
});
