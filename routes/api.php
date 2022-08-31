<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/menus', App\Http\Controllers\MenuController::class);
Route::apiResource('/profilhotels', App\Http\Controllers\ProfilhotelController::class);
Route::apiResource('/jeniskategoris', App\Http\Controllers\JeniskategoriController::class);

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

// /**
//  * route resource post
//  */
// Route::resource('/profilhotels', ProfilhotelController::class);