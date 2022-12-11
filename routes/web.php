<?php

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