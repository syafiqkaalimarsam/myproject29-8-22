<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ManagerController;
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

Route::get('/', function () {
    return view('login');
});


Route::get('login',[AuthController::class,'index'])->name('login');
Route::post('proses_login',[AuthController::class,'proses_login'])->name('proses_login');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function() {
    Route::group(['middleware' => ['Cek_login:admin']], function() {
        Route::get('admin',[AdminController::class,'index'])->name('admin');
    });
    Route::group(['middleware' => ['Cek_login:kasir']], function() {
        Route::get('kasir',[KasirController::class,'index'])->name('kasir');
    });
    Route::group(['middleware' => ['Cek_login:manager']], function() {
        Route::get('manager',[ManagerController::class,'index'])->name('manager');
    });

});



// crud pesanan

// Route::get('/pesanan', [AgendaController::class,'index']);

// Route::post('/save-pesanan', [AgendaController::class,'store'])->name('simpan-pesanan');
// Route::get('/create-pesanan', [AgendaController::class,'create']);