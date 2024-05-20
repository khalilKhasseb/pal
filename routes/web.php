<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Theme\ContentController;
use App\Http\Controllers\GoogleApiAuthController;
use App\Livewire\Home;
use App\Http\Controllers\Google\FormsController;
use App\Models\GoogleForm;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use LaraZeus\Sky\Livewire\Post;
use LaraZeus\Sky\Livewire\Posts;
use LaraZeus\Sky\Livewire\Tags;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class , 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



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

 
    Route::get('/post-single', fn() => view('theme.pages.post'));
});


Route::prefix('/ajax')->name('ajax.')->group(function () {
    Route::get('/like_post/{post:slug}', [App\Http\Controllers\Theme\ContentController::class, 'like_post'])->name('like_post');
    Route::get('/dislike-post/{post:slug}', [App\Http\Controllers\Theme\ContentController::class, 'dislike_post'])->name('dislike_post');
});

Route::get('/home-sommod', Home::class)->name('home');


// Route::get('/{id}/posts', [App\Http\Controllers\Theme\ContentController::class, 'author_posts'])->name('author_posts');
// Route::get('/test', [App\Http\Controllers\Theme\ContentController::class, 'test']);
// Route::get('/forms', [ContentController::class, 'connect']);
// Route::get('/token', [ContentController::class, 'set_token'])->name('token');
// Route::get('/ft', [ContentController::class, 'fetch_forms']);



Route::prefix('google/')->name('google.')->group(function () {
    Route::get('authnticate', [GoogleApiAuthController::class, 'redirectToAuthnitcateUrl'])->name('redirect');
    Route::get('callback', [GoogleApiAuthController::class, 'callback'])->name('callback');
    Route::get('refresh_token', [GoogleApiAuthController::class, 'refreshToken']);
});


Route::prefix('events')->name('event')->group(function () {
    Route::get('/', App\Livewire\Events::class);
    Route::get(config('zeus-sky.uri.post') . '/{slug}', Post::class)->name('.single');
    // Route::get('/{slug}', function (Request $request) {
    //     dump($request->slug);
    // })->name('single');
});



Route::prefix('administration')->name('administration')->group(function () {
    Route::get('/', App\Livewire\AdminstrationComp::class);

    Route::get('/{slug}', App\Livewire\SingleAdministration::class)->name('.view');
});

Route::prefix('partner')->name('partners')->group(function () {
    Route::get('/', Posts::class);
    Route::get('/{slug}', Post::class)->name('.view');
});

Route::prefix('service')->name('service')->group(function () {
    Route::get('/', Posts::class);
    Route::get('/{slug}', Post::class)->name('.view');
});

Route::prefix('product')->name('product')->group(function () {
    Route::get('/', Posts::class);
    Route::get('/{slug}', Post::class)->name('.view');
});
Route::prefix('activity')->name('activity')->group(function () {
    Route::get('/', Posts::class);
    Route::get('/{slug}', Post::class)->name('.view');
});

Route::prefix('hall')->name('hall')->group(function () {
    Route::get('/', Posts::class);
    Route::get('/{slug}', Post::class)->name('.view');
});

Route::prefix('initiative')->name('initiative')->group(function () {
    Route::get('/', Posts::class);
    Route::get('/{slug}', Post::class)->name('.view');
});

Route::post('/contact', App\Http\Controllers\ContactController::class)->name('contact');


/**
 * First try to copy file from remote path to a give destnation 
 * Destination will be stroage folder of laravel 
 * if any errors abort operation and log to a log file with erros
 * send email with logs
 * 
 * attache media to model for each post model 
 */
Route::get('/img', function (Request $request) {
    $url = 'https://www.palgbc.org/img/news/news266.jpg';

    $posts = App\Models\Post::all();

    $posts->map(function ($post) use ($url) {
        // cehck if fimg not null 
        if (!is_null($post->featured_image) && count($post->getMedia('posts')) === 0) {

            $url = $post->featured_image;

        }
        $post->addMediaFromUrl($url)
            ->withResponsiveImages()
            ->toMediaCollection('posts');

        $post->featured_image = null;
        $post->save();
        return $post;
    });


});

Route::get('/umedia/{id}', function (Request $request) {
       $url = 'https://www.palgbc.org/panel/img/couNews/344419951_892054171892029_8435259809089718114_n%20(1).jpg';

    $post = App\Models\Post::find($request->id); 

    // chcck if has media 

    if($post->hasMedia('posts')) {

        $post->clearMediaCollection('posts');
        $meida = $post->addMediaFromUrl($url)
        ->withResponsiveImages()
        ->toMediaCollection('posts');

       
    }
 });

Route::get('/mediadelete', function (Request $request) {

    // load modal 

    $posts = App\Models\Post::all();

    $posts = $posts->each(function ($post) {

        // check if has media 
        if ($post->hasMedia('posts')) {
            // pefrom delete media 
            $post->clearMediaCollection('posts');
            // $media = $post->getMedia('posts');
            return $post;
        }
    });

    foreach ($posts as $post) {
        dump($post->hasMedia('posts'));
    }


});




