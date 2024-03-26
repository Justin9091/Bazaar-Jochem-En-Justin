<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdvertismentController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LandingPageCreatorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get("/register", [RegisterController::class, 'index']);
Route::post("/register", [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/advertisment/{id}', [AdvertismentController::class, 'show'])->name('advertisment');

Route::get('/seller/{userId}', [SellerController::class, 'show'])->name('sellerprofile');
Route::post('/add-review', [ReviewController::class, 'addReview'])->name('add_review');

Route::post('/image/{folder?}/{name?}', [ImageController::class, 'store'])->name('image');

Route::middleware(['auth'])->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account');

    Route::post('/bid/{advertisment}', [BidController::class, 'bid'])->name('bid');


    Route::get('/favorite/{advertisment}', [FavoriteController::class, 'favorite'])->name('favorite');

    Route::get('/landing/editor', [LandingPageCreatorController::class, 'index'])->name('landing.editor');
    Route::post('/landing/editor/add', [LandingPageCreatorController::class, 'addComponent'])->name('landing.editor.add-component');
    Route::get('/landing/editor/remove/{id}', [LandingPageCreatorController::class, 'removeComponent'])->name('landing.editor.remove-component');
    Route::get('/landing/editor/up/{id}', [LandingPageCreatorController::class, 'moveComponentUp'])->name('landing.editor.up-component');
    Route::get('/landing/editor/down/{id}', [LandingPageCreatorController::class, 'moveComponentDown'])->name('landing.editor.down-component');
});

// ToDo remove later
Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});

// In routes/web.php
Route::post('/search', [SearchController::class, 'search'])->name('search');
Route::post('/clear-search', [SearchController::class, 'clearSearch'])->name('clear-search-term');

