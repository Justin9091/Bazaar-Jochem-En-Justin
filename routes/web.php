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
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RelatedAdController;
use App\Http\Controllers\RetourController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Middleware\CanPlaceAdvertisements;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CSVController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\ContractController;

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

Route::get('/', [HomeController::class, 'index'])->name("home");
Route::get("/register", [RegisterController::class, 'index'])->name("register");
Route::post("/register", [RegisterController::class, 'store'])->name("register.store");

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.store');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/advertisement/{id}', [AdvertisementController::class, 'show'])->name('advertisement');
Route::post('/advertisement/{id}/rentitem', [RentController::class, 'rentitem'])->name('advertisement.rent');


Route::get('/seller/{userId}', [SellerController::class, 'show'])->name('sellerprofile');
Route::post('/add-reviews', [ReviewController::class, 'addReview'])->name('add_review');

Route::get('/seller/{userId}/createqr', [SellerController::class, 'createqr'])->name('sellers.createqr');

Route::get('/{userid}/contract/download-contract', [ContractController::class, 'downloadContract'])->name('download.contract');
Route::post('/{userid}/contract/upload-contract', [ContractController::class, 'uploadContract'])->name('upload.contract');
Route::get('/{userid}/contract',[ContractController::class, 'index'])->name('contract.index');


Route::post('/image/{folder?}/{name?}', [ImageController::class, 'store'])->name('image');

Route::get('/seller/{userId}/createcsv', [CSVController::class, 'createcsv'])->name('sellers.createcsv');
Route::post('/seller/{userId}/importcsv', [CSVController::class, 'importcsv'])->name('sellers.importcsv');

Route::middleware(CanPlaceAdvertisements::class)->prefix("/seller/{userId}/")->group(function () {
    Route::get('addadvertisement', [SellerController::class, 'showaddadvertisementform'])->name('sellers.addadvertisement');
    Route::post('addadvertisement', [SellerController::class, 'createadvertisement'])->name('sellers.createadvertisement');
});

Route::get('/seller/{userid}/{date}', [RentController::class, 'createagenda'])->name('sellers.createagenda');

Route::middleware(['auth'])->group(function () {

    Route::get('/account', [AccountController::class, 'index'])->name('account');

    Route::post('/bid/{advertisement}', [BidController::class, 'bid'])->name('bid');


    Route::get('/favorite/{advertisement}', [FavoriteController::class, 'favorite'])->name('favorite');

    Route::prefix("/landing/editor")->controller(LandingPageCreatorController::class)->group(function () {
        Route::get('/', 'index')->name('landing.editor');
        Route::post('/add', 'addComponent')->name('landing.editor.add-component');
        Route::get('/remove/{id}', 'removeComponent')->name('landing.editor.remove-component');
        Route::get('/up/{id}', 'moveComponentUp')->name('landing.editor.up-component');
        Route::get('/down/{id}', 'moveComponentDown')->name('landing.editor.down-component');
        Route::post('/colors', 'updateColor')->name('landing.editor.color');
    });

    Route::prefix('/related')->controller(RelatedAdController::class)->group(function () {
        Route::post('/add/{baseAdvertisementId}', 'addRelatedAd')->name('related.add');
        Route::get('/remove/{baseAdvertisementId}/{relatedAdvertisementId}', 'removeRelatedAd')->name('related.remove');
    });

    Route::get('/return', [AdvertisementController::class, 'returnItem'])->name('return');
    Route::post('/return', [AdvertisementController::class, 'storeReturnedItem'])->name('return.store');
    Route::post('/return/list', [RetourController::class, 'show'])->name('return.list');

    Route::post('/shorturl/edit', [ShortUrlController::class, 'edit']);
});

Route::post('/language', [LanguageController::class, 'switch'])->name('language.switch');
Route::post('/search', [SearchController::class, 'search'])->name('search');
Route::post('/clear-search', [SearchController::class, 'clearSearch'])->name('clear-search-term');

// Deze moet onderaan staan anders denkt Laravel dat elke route deze is
Route::get('/{url}', [ShortUrlController::class, 'url']);
