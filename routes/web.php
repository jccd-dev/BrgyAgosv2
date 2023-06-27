<?php

use App\Http\Controllers\Dashboard\ImportExportProfile;
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
    // Route::get('/profiling', [Profiling::class, 'render'])->name('d-profiling');
    Route::controller(Profiling::class)->group(function () {
        Route::get('/profiling', 'render')->name('d-profiling');
        Route::post('/add-profile', 'add_profile')->name('d-profiling-add');
        Route::get('/get-profile', 'get_all_profiles')->name('d-getProfile');
    });

    Route::controller(ImportExportProfile::class)->group( function () {
        Route::post('/import', 'import_excel_file')->name('d-import');
        Route::get('/export', 'exportProfiles')->name('d-export');
    } );
});
