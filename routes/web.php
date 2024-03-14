<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdvertismentController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CSVController;
use \App\Http\Controllers\RentController;

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
Route::get('/seller/{userId}/addadvertisement', [SellerController::class, 'showaddadvertisementform'])->name('sellers.addadvertisement');
Route::post('/seller/{userId}/addadvertisement', [SellerController::class, 'createadvertisement'])->name('sellers.createadvertisement');
Route::get('/seller/{userId}/createqr', [SellerController::class, 'createqr'])->name('sellers.createqr');

Route::get('/seller/{userId}/createcsv', [CSVController::class, 'createcsv'])->name('sellers.createcsv');
Route::post('/seller/{userId}/importcsv', [CSVController::class, 'importcsv'])->name('sellers.importcsv');

Route::get('/seller/{userid}/{date}', [RentController::class, 'createagenda'])->name('sellers.createagenda');

Route::middleware(['auth'])->group(function () {
    Route::get('/properties', [PropertiesController::class, 'index'])->name('properties');
    Route::post('/properties/{property}', [PropertiesController::class, 'update']);

    Route::get('/account', [AccountController::class, 'index'])->name('account');

    Route::post('/bid/{advertisment}', [BidController::class, 'bid'])->name('bid');


    Route::get('/favorite/{advertisment}', [FavoriteController::class, 'favorite'])->name('favorite');

    Route::post('/shorturl/edit', [ShortUrlController::class, 'edit']);
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

// Deze moet onderaan staan anders denkt Laravel dat elke route deze is
Route::get('/{url}', [ShortUrlController::class, 'url']);
