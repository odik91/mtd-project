<?php

use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\PengaturanHalamanUtama;
use App\Http\Controllers\admin\SuvenirController;
use App\Http\Controllers\admin\TourController;
use App\Http\Controllers\Public\HomeController;
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
    return redirect()->route('home.index');
});

Route::resource('/home', HomeController::class);
Route::get('/paket-wisata', [HomeController::class, 'travelPackages'])->name('paket-wisata');
Route::get('/paket-detail', [HomeController::class, 'singlePage'])->name('paket-detail');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/detail-wisata/{slug}', [HomeController::class, 'travelDetail'])->name('detail-wisata');

// oleh-oleh
Route::get('/oleh-oleh', [HomeController::class, 'suvenirs'])->name('oleh-oleh');
Route::get('/oleh-oleh/{slug}', [HomeController::class, 'detailSuvenir'])->name('oleh-oleh.single');


Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', function () {
        return redirect()->route('dashboard.index');
    });

    Route::resource('/dashboard', dashboardController::class);

    // main settings
    Route::resource('/main-settings', PengaturanHalamanUtama::class);
    Route::match(['PUT', 'PATCH'], 'edit/services/main-setting/{id}', [PengaturanHalamanUtama::class, 'editMainServices'])->name('main-settings.edit-services');
    Route::match(['PUT', 'PATCH'], 'edit/evlevator/{id}', [PengaturanHalamanUtama::class, 'editElevatorPitch'])->name('main-settings.edit-ev');
    Route::post('/main-setting', [PengaturanHalamanUtama::class, 'OurServices'])->name('main-settings.OurService');
    Route::match(['PUT', 'PATCH'], 'edit/our-service/{id}', [PengaturanHalamanUtama::class, 'EditOurService'])->name('main-settings.edit-our-service');
    Route::delete('edit/our-service/{id}', [PengaturanHalamanUtama::class, 'DeleteOurService'])->name('main-settings.delete-our-service');

    // travel package
    Route::resource('/tour-travel', TourController::class);
    Route::post('/add-tour', [TourController::class, 'addTravelPackage'])->name('tour-travel.add-package');
    Route::match(['PUT', 'PATCH'], '/add-tour/{id}', [TourController::class, 'editTravelPackage'])->name('tour-travel.edit-package');
    Route::delete('/add-tour/{id}', [TourController::class, 'deleteTravelPackage'])->name('tour-travel.delete-package');

    // oleh-oleh
    Route::resource('/oleh-oleh', SuvenirController::class);
    Route::post('/oleh-olehnya', [SuvenirController::class, 'addSuvenirItem'])->name('oleh-oleh.add-item');
    Route::match(['PUT', 'PATCH'], '/oleh-olehnya/{id}', [SuvenirController::class, 'editSuvenirItem'])->name('oleh-oleh.edit-item');
    Route::delete('/oleh-olehnya/{id}', [SuvenirController::class, 'deleteSuvenirItem'])->name('oleh-oleh.delete-item');

    // about
    Route::resource('about', AboutController::class);
});

Auth::routes([
    // 'register' => false
]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
