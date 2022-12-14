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
Route::get('/about', [HomeController::class, 'contact'])->name('contact');
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
    Route::put('satatus-testimoni/{id}', [PengaturanHalamanUtama::class, 'setActivaionTestimoni'])->name('ajax.status-testimoni');
    Route::delete('satatus-testimoni/{id}', [PengaturanHalamanUtama::class, 'deleteTestimoni'])->name('delete.status-testimoni');
    Route::put('satatus-suvenir/{id}', [PengaturanHalamanUtama::class, 'setActivationSuvenir'])->name('ajax.status-suvenir');
    Route::put('satatus-wisata/{id}', [PengaturanHalamanUtama::class, 'setWisataActivation'])->name('ajax.status-wisata');
    Route::put('satatus-service/{id}', [PengaturanHalamanUtama::class, 'setServiceActivation'])->name('ajax.status-service');
    Route::put('satatus-slider/{id}', [PengaturanHalamanUtama::class, 'setSliderActivation'])->name('ajax.status-slider');
    
    // travel package
    Route::resource('/tour-travel', TourController::class);
    Route::post('/add-tour', [TourController::class, 'addTravelPackage'])->name('tour-travel.add-package');
    Route::match(['PUT', 'PATCH'], '/add-tour/{id}', [TourController::class, 'editTravelPackage'])->name('tour-travel.edit-package');
    Route::delete('/add-tour/{id}', [TourController::class, 'deleteTravelPackage'])->name('tour-travel.delete-package');
    Route::match(['PUT', 'PATCH'], '/activate-tour/{id}', [TourController::class, 'setActiveWisata'])->name('activate-wisata');
    Route::match(['PUT', 'PATCH'], '/activate-package/{id}', [TourController::class, 'setActivePackage'])->name('activate-package');

    // oleh-oleh
    Route::resource('/oleh-oleh', SuvenirController::class);
    Route::post('/oleh-olehnya', [SuvenirController::class, 'addSuvenirItem'])->name('oleh-oleh.add-item');
    Route::match(['PUT', 'PATCH'], '/oleh-olehnya/{id}', [SuvenirController::class, 'editSuvenirItem'])->name('oleh-oleh.edit-item');
    Route::delete('/oleh-olehnya/{id}', [SuvenirController::class, 'deleteSuvenirItem'])->name('oleh-oleh.delete-item');
    Route::match(['PUT', 'PATCH'], '/status-oleh-olehnya/{id}', [SuvenirController::class, 'setActivePackage'])->name('oleh-oleh.status');

    // about
    Route::resource('about', AboutController::class);
    Route::post('add-contact', [AboutController::class, 'saveContact'])->name('about.add-contact');
    Route::match(['PUT', 'PATCH'],'edit-contact/{id}', [AboutController::class, 'editContact'])->name('about.edit-contact');
    Route::delete('delete-contact/{id}', [AboutController::class, 'deleteContact'])->name('about.delete-contact');

    Route::post('add-social-media', [AboutController::class, 'addSocialMedia'])->name('about.add-sosmed');
    Route::match(['PUT', 'PATCH'],'edit-social-media/{id}', [AboutController::class, 'editSocialMedia'])->name('about.edit-sosmed');
    Route::delete('delete-social-media/{id}', [AboutController::class, 'deleteSocialMedia'])->name('about.delete-sosmed');
});

Auth::routes([
    'register' => false
]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
