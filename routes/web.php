<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Home;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Dashboard\Profiling;
use App\Http\Controllers\Dashboard\FamiliesController;
use App\Http\Controllers\Dashboard\ImportExportProfile;

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

Route::get('/', [AdminController::class, 'index'])->name('base');
Route::post('/login', [AdminController::class, 'login'])->name('login');

Route::prefix('dashboard')->middleware('admin.auth')->group(function(){
    Route::get('/', [Home::class, 'render'])->name('d-home');
    // Route::get('/profiling', [Profiling::class, 'render'])->name('d-profiling');
    Route::controller(Profiling::class)->group(function () {
        Route::get('/profiling', 'render')->name('d-profiling');
        Route::post('/add-profile', 'add_profile')->name('d-profiling-add');
        Route::get('/get-profile', 'get_all_profiles')->name('d-getProfile');
        Route::get('/update/{id}', 'update_page')->name('d-update');
        Route::post('/update-profile', 'update_profile')->name('d-update-profile');
        Route::delete('/delete-profile/{id}', 'delete_profile')->name('d-delete-profile');
        Route::get('/get-option', 'get_a_profile');
    });

    Route::controller(ImportExportProfile::class)->group( function () {
        Route::post('/import', 'import_excel_file')->name('d-import');
        Route::get('/export', 'exportProfiles')->name('d-export');
    } );

    Route::controller(FamiliesController::class)->group( function (){
        Route::get('/families', 'render')->name('d-family');
        Route::post('/add-family', 'add_family')->name('d-add.family');
    });

    Route::controller(AdminController::class)->group(function () {
        Route::get('/setting', 'renderSetting')->name('d-admin.setting');
        Route::post('/update-admin', 'update')->name('d-admin.update');
        Route::get('/logout', 'destroy')->name('d-admin.logout');
    });
});
