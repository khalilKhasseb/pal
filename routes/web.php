<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleApiAuthController;
use App\Livewire\Home;
use LaraZeus\Sky\Livewire\Post;
use LaraZeus\Sky\Livewire\Posts;
use Illuminate\Http\Request;

use App\Http\Controllers\LahzaPayController;
use App\Livewire\Payment\PaymentForm;
use App\Models\PaymentInfo;
use Lahza\PaymentGateway\Facades\Lahza;
use Illuminate\Support\Str;

use Lahza\PaymentGateway\Exceptions\PaymentException;
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

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


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


Route::get('all_content', function (Request $request) {
    // there is a config key has a boolean valude indicate if we have to fetch all content or not
    // this route only resposnibel to only chagne the config value between true or false 
    // if it false set to true and vis vers

    // get the key 

    // set it in the current user session

    // for the first time there is no key in the sessin and its not been set 

    if (session()->has('show_all_content') && session('show_all_content')) {
        // thats mean its ben activated and now to disable it

        session()->put('show_all_content', false);

        return back();
    }

    $value = session()->get('show_all_content', false);

    session()->put('show_all_content', !$value);

    return back();
})->name('admin.all_content');



require __DIR__ . '/auth.php';



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
    Route::get('/like_post/{id}', [App\Http\Controllers\Theme\ContentController::class, 'like_post'])->name('like_post');
    Route::get('/dislike-post/{id}', [App\Http\Controllers\Theme\ContentController::class, 'dislike_post'])->name('dislike_post');
});

Route::get('/home-sommod', Home::class)->name('front.somoud.home');


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

Route::prefix('cources')->name('cource')->group(function () {
    Route::get('/', App\Livewire\CourcePage::class);
});


Route::prefix('events')->name('event')->group(function () {
    Route::get('/', App\Livewire\Events::class);
    Route::get(config('zeus-sky.uri.post') . '/{slug}', Post::class)->name('.single');
});


Route::prefix('supporters')->name('supporters')->group(function () {
    Route::get('/', function () {});
});

Route::prefix('partners')->name('partners')->group(function () {
    Route::get('/', Posts::class);
});

Route::prefix('administration')->name('administration')->group(function () {
    Route::get('/', App\Livewire\AdminstrationComp::class);

    Route::get('/{slug}', App\Livewire\SingleAdministration::class)->name('.view');
});
Route::prefix('experts')->name('experts')->group(function () {
    Route::get('/', App\Livewire\Experts::class);

    Route::get('/{expert}', App\Livewire\Expert::class)->name('.view');
});


Route::prefix('partner')->name('partner')->group(function () {
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
    Route::get('/', App\Livewire\InitiativesPage::class);
    Route::get('/{slug}', Post::class)->name('.view');
});

Route::get('/faqs', App\Livewire\FaqPage::class)->name('faq');

Route::get('gallary', App\Livewire\GallaryPage::class);
Route::post('/contact', App\Http\Controllers\ContactController::class)->name('contact');

Route::get('attachment/{media}', App\Http\Controllers\DownloadMedia::class)
    ->middleware('auth')
    ->name('downloadAttachment')
;


Route::get('checkout', PaymentForm::class)->name('checkout');
// Route::post('payment/callback', App\Http\Controllers\PaymentCallbackController::class)->name('payment.callback');

Route::get('lang/{local}', function (Request $request, $local) {
    session()->put('lang', $local);
    return back();
})->name('local');


Route::prefix('ajax')->name('ajax.')->group(function () {
    Route::post('/sendExpertEmail', [AjaxController::class, 'sendExpertEmail'])->name('sendExpertEmail');
    Route::post('/requestCertificate', [AjaxController::class, 'requestCertificate'])->name('requestCertificate');
    Route::post('/logError', [AjaxController::class, 'logError'])->name('logError');
});
Route::get('dashboard/library', [DashboardController::class, 'getTagItemsBySlug'])->name('library.getBySlug');
/**
 * First try to copy file from remote path to a give destnation
 * Destination will be stroage folder of laravel
 * if any errors abort operation and log to a log file with erros
 * send email with logs
 *
 * attache media to model for each post model
 */



Route::get('/payment', PaymentForm::class)->name('payment.form');

// Route for displaying the payment success page
// Route::get('/payment-success', function () {
//     return view('lahza.payment-success');
// })->name('payment.success');


// routes/web.php

Route::group(['prefix' => 'payment'], function () {
    Route::get('/callback', [LahzaPayController::class, 'handleCallback'])
        ->name('/callback');
    Route::get('/receipt/{payment}', [LahzaPayController::class, 'downloadReceipt'])
        ->name('payment.receipt');

    Route::get('/receipt/{reference}/download', [LahzaPayController::class, 'handleCallback'])
        ->name('payment.receipt.download');

    Route::get('/success/{payment}', function (PaymentInfo $payment) {
        return view('lahza.payment-success', compact('payment'));
    })->name('payment.success');

    Route::get('/failure/{payment}', function (PaymentInfo $payment) {
        return view('lahza.failure', compact('payment'));
    })->name('payment.failure');
});
