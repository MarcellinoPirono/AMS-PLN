<?php

use App\Models\Rab;
use App\Http\Controllers\ItemRincianInduk;
use App\Http\Controllers\ItemRincianIndukController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RabController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PrkController;
use App\Http\Controllers\SkkController;
use App\Http\Controllers\RincianIndukController;
use App\Http\Controllers\HpeController;
use App\Http\Controllers\JenisKhsController;
use App\Http\Controllers\KontrakIndukController;
use App\Http\Controllers\KhsController;
use App\Http\Controllers\PdfkhsController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AddendumController;
use App\Models\Vendor;
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

Route::get('/dashboard', [MainController::class, 'index']);
Route::get('/login', [LoginController::class, 'login']);

Route::resource('categories', ItemRincianIndukController::class);
Route::get('/search-categories', [ItemRincianIndukController::class, 'searchcategories']);


//KHS
Route::get('item-khs/{jenis_khs}', [RincianIndukController::class, 'jenis_khs']);
Route::get('item-khs/{jenis_khs}/create', [RincianIndukController::class, 'create']);
Route::post('item-khs/{jenis_khs}/create', [RincianIndukController::class, 'store']);

Route::resource('item-khs', RincianIndukController::class);
        
Route::resource('jenis-khs', KhsController::class);
Route::get('/search-jenis-khs', [KhsController::class, 'searchjeniskhs']);


Route::resource('vendor-khs', VendorController::class);
Route::resource('kontrak-induk-khs', KontrakIndukController::class);
Route::resource('addendum-khs', AddendumController::class);
// Route::post('getNoKontrakInduk', [AddendumController::class, 'getNoKontrakInduk']);
// Route::resource('addendum-khs ', AddendumController::class);


//MENU
Route::get('/menu-item-khs', [MenuController::class, 'MenuItemKHS']);


Route::any('rincian/filter', [RincianIndukController::class, 'filter']);
Route::get('/search-rincian', [RincianIndukController::class, 'searchRincian']);

Route::get('deleteitem/{id}', [RincianIndukController::class, 'destroy']);

Route::resource('khs', RabController::class);
Route::get('/buat-kontrak', [RabController::class, 'buat_kontrak']);


Route::resource('skk', SkkController::class);
Route::post('getSKK', [SkkController::class, 'getSKK']);
Route::post('getCategory', [SkkController::class, 'getCategory']);
Route::post('getItem', [SkkController::class, 'getItem']);
Route::post('getKontrakInduk', [SkkController::class, 'getKontrakInduk']);

Route::resource('prk', PrkController::class);
Route::get('deleteskk/{id}', [SkkController::class, 'destroy']);

Route::get('deleteprk/{id}', [PrkController::class, 'destroy']);

Route::resource('hpe', HpeController::class);

Route::resource('surat', PdfkhsController::class);

// Route::view('products', 'layouts.main', [
// 'data' => App\Http\Controllers\MainController::all()
// ]);
