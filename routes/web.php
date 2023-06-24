<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Home;
use App\Http\Controllers\Dashboard\Profiling;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main-layout');
});

Route::prefix('dashboard')->group(function(){
    Route::get('/home', [Home::class, 'render'])->name('d-home');
    Route::get('/profiling', [Profiling::class, 'render'])->name('d-profiling');
});
