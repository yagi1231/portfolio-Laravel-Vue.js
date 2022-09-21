<?php

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

Route::prefix('reservations')->middleware('auth')->group(function(){
    Route::get('/', [ ReservationController::class, 'index'])->name('reservation/index');
    Route::get('/create', [ ReservationController::class, 'create'])->name('reservation/create');
    Route::post('/store', [ ReservationController::class, 'store'])->name('reservation/store');
    Route::get('/edit/{id}', [ ReservationController::class, 'edit'])->name('reservation/edit');
    Route::get('/update/{id}', [ ReservationController::class, 'update'])->name('reservation/update');
    Route::post('/update/{id}', [ ReservationController::class, 'update'])->name('reservation/update');
    Route::get('/delete/{id}', [ ReservationController::class, 'destroy'])->name('reservation/delete');
});

