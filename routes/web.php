<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LandingPageCreatorController;
use App\Http\Controllers\LanguageController;
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

Route::get('/advertisement/{id}', [AdvertisementController::class, 'show'])->name('advertisement');
Route::get('/advertisement/{id}/rentitem', [RentController::class, 'rentitem'])->name('rentitem');


Route::get('/seller/{userId}', [SellerController::class, 'show'])->name('sellerprofile');
Route::post('/add-review', [ReviewController::class, 'addReview'])->name('add_review');
Route::get('/seller/{userId}/addadvertisement', [SellerController::class, 'showaddadvertisementform'])->name('sellers.addadvertisement');
Route::post('/seller/{userId}/addadvertisement', [SellerController::class, 'createadvertisement'])->name('sellers.createadvertisement');
Route::get('/seller/{userId}/createqr', [SellerController::class, 'createqr'])->name('sellers.createqr');


Route::post('/image/{folder?}/{name?}', [ImageController::class, 'store'])->name('image');

Route::get('/seller/{userId}/createcsv', [CSVController::class, 'createcsv'])->name('sellers.createcsv');
Route::post('/seller/{userId}/importcsv', [CSVController::class, 'importcsv'])->name('sellers.importcsv');

Route::get('/seller/{userid}/{date}', [RentController::class, 'createagenda'])->name('sellers.createagenda');

Route::middleware(['auth'])->group(function () {
    Route::get('/account', [AccountController::class, 'index'])->name('account');

    Route::post('/bid/{advertisement}', [BidController::class, 'bid'])->name('bid');


    Route::get('/favorite/{advertisement}', [FavoriteController::class, 'favorite'])->name('favorite');

    Route::get('/landing/editor', [LandingPageCreatorController::class, 'index'])->name('landing.editor');
    Route::post('/landing/editor/add', [LandingPageCreatorController::class, 'addComponent'])->name('landing.editor.add-component');
    Route::get('/landing/editor/remove/{id}', [LandingPageCreatorController::class, 'removeComponent'])->name('landing.editor.remove-component');
    Route::get('/landing/editor/up/{id}', [LandingPageCreatorController::class, 'moveComponentUp'])->name('landing.editor.up-component');
    Route::get('/landing/editor/down/{id}', [LandingPageCreatorController::class, 'moveComponentDown'])->name('landing.editor.down-component');
    Route::post('/landing/editor/colors', [LandingPageCreatorController::class, 'updateColor'])->name('landing.editor.color');

    Route::post('/shorturl/edit', [ShortUrlController::class, 'edit']);
});

Route::post('language', [LanguageController::class, 'switch'])->name('language.switch');

// In routes/web.php
Route::post('/search', [SearchController::class, 'search'])->name('search');
Route::post('/clear-search', [SearchController::class, 'clearSearch'])->name('clear-search-term');

// Deze moet onderaan staan anders denkt Laravel dat elke route deze is
Route::get('/{url}', [ShortUrlController::class, 'url']);
