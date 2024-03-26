<?php

use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/reviews/{apitoken}', [ApiController::class, 'getReviews']);
Route::get('/advertisements/{apitoken}', [ApiController::class, 'getAdvertisements']);
Route::get('/advertisements-reviews/{apitoken}', [ApiController::class, 'getAdvertisementsAndReviews']);


