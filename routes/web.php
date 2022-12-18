<?php

use App\Http\Controllers\admin\dashboardController;
use App\Http\Controllers\admin\PengaturanHalamanUtama;
use App\Http\Controllers\admin\SuvenirController;
use App\Http\Controllers\admin\TourController;
use App\Http\Controllers\Public\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/home', HomeController::class);
Route::get('/paket-wisata', [HomeController::class, 'travelPackages'])->name('paket-wisata');
Route::get('/paket-detail', [HomeController::class, 'singlePage'])->name('paket-detail');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::group(['prefix' => 'admin', 'middleware' => ['guest']], function () {
    Route::resource('/dashboard', dashboardController::class);

    Route::resource('/main-settings', PengaturanHalamanUtama::class);
    Route::match(['PUT', 'PATCH'], 'edit/services/main-setting/{id}', [PengaturanHalamanUtama::class, 'editMainServices'])->name('main-settings.edit-services');
    Route::match(['PUT', 'PATCH'], 'edit/evlevator/{id}', [PengaturanHalamanUtama::class, 'editElevatorPitch'])->name('main-settings.edit-ev');
    Route::post('/main-setting', [PengaturanHalamanUtama::class, 'OurServices'])->name('main-settings.OurService');
    Route::match(['PUT', 'PATCH'], 'edit/our-service/{id}', [PengaturanHalamanUtama::class, 'EditOurService'])->name('main-settings.edit-our-service');
    Route::delete('edit/our-service/{id}', [PengaturanHalamanUtama::class, 'DeleteOurService'])->name('main-settings.delete-our-service');

    Route::resource('/tour-travel', TourController::class);

    Route::resource('/oleh-oleh', SuvenirController::class);
});
