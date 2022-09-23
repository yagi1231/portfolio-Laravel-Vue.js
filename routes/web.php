<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function(){
    Route::prefix('reservations')->group(function(){
      Route::get('/', [ ReservationController::class, 'index'])->name('reservation/index');
      Route::get('/create', [ ReservationController::class, 'create'])->name('reservation/create');
      Route::post('/create', [ ReservationController::class, 'create'])->name('reservation/create');
      Route::post('/store', [ ReservationController::class, 'store'])->name('reservation/store');
      Route::get('/edit/{id}', [ ReservationController::class, 'edit'])->name('reservation/edit');
      Route::get('/update/{id}', [ ReservationController::class, 'update'])->name('reservation/update');
      Route::post('/update/{id}', [ ReservationController::class, 'update'])->name('reservation/update');
      Route::get('/delete/{id}', [ ReservationController::class, 'destroy'])->name('reservation/delete');
      Route::get('/restore/{id}', [ ReservationController::class, 'destroy'])->name('reservation/restore');
    });

    Route::prefix('customers')->group(function(){
        Route::get('/', [ CustomerController::class, 'index'])->name('customer/index');
        Route::get('/create', [ CustomerController::class, 'create'])->name('customer/create');
        Route::get('/show/{id}', [ CustomerController::class, 'show'])->name('customer/show');
        Route::post('/store', [ CustomerController::class, 'store'])->name('customer/store');
        Route::get('/edit/{id}', [ CustomerController::class, 'edit'])->name('customer/edit');
        Route::get('/update/{id}', [ CustomerController::class, 'update'])->name('customer/update');
        Route::post('/update/{id}', [ CustomerController::class, 'update'])->name('customer/update');
        Route::get('/delete/{id}', [ CustomerController::class, 'destroy'])->name('customer/delete');
        Route::get('/restore/{id}', [ CustomerController::class, 'restore'])->name('customer/restore');
      });
});

