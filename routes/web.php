<?php

use App\Http\Controllers\BerkasController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\PeriodeController;
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

Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('layouts.admin');
    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('periode', PeriodeController::class);
    Route::resource('jenjang', JenjangController::class);
    Route::resource('berkas', BerkasController::class);
});
