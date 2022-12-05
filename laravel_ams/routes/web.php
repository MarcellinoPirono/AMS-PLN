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
use App\Http\Controllers\NonPOController;
use App\Http\Controllers\PejabatController;
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
Route::get('item-khs/{jenis_khs}/{id}/edit', [RincianIndukController::class, 'edit'])->name('item-khs.edit');
Route::get('item-khs/{jenis_khs}/{id}', [RincianIndukController::class, 'destroy']);
Route::any('item-khs/{jenis_khs}/filter', [RincianIndukController::class, 'filteritem']);
Route::put('item-khs/{jenis_khs}/{id}/edit', [RincianIndukController::class, 'update']);


// Route::put('item-khs/{jenis_khs}/{id}/update', [RincianIndukController::class, 'update']);


// Route::resource('item-khs', RincianIndukController::class);

Route::resource('jenis-khs', KhsController::class);
Route::get('/search-jenis-khs', [KhsController::class, 'searchjeniskhs']);

//Vendor KHS
Route::resource('vendor-khs', VendorController::class);
Route::get('/search-vendor', [VendorController::class, 'searchvendor']);

//Kontrak Induk KHS
Route::resource('kontrak-induk-khs', KontrakIndukController::class);
Route::any('kontrak-induk-khs/filter', [KontrakIndukController::class, 'filterkontrakinduk']);
Route::get('/search-kontrak-induk', [KontrakIndukController::class, 'searchkontrakinduk']);

//Addendum KHS
Route::resource('addendum-khs', AddendumController::class);
Route::any('addendum-khs/filter', [AddendumController::class, 'filteraddendum']);
Route::get('/search-addendum-khs', [AddendumController::class, 'searchaddendumkhs']);
// Route::post('getNoKontrakInduk', [AddendumController::class, 'getNoKontrakInduk']);
// Route::resource('addendum-khs ', AddendumController::class);

//Pejabat
Route::resource('pejabat', PejabatController::class);
Route::get('/search-pejabat', [PejabatController::class, 'searchpejabat']);

//MENU
Route::get('/menu-item-khs', [MenuController::class, 'MenuItemKHS']);


Route::any('rincian/filter', [RincianIndukController::class, 'filter']);
Route::get('/search-rincian', [RincianIndukController::class, 'searchRincian']);

Route::get('deleteitem/{id}', [RincianIndukController::class, 'destroy']);

//PO KHS
Route::get('po-khs/buat-po', [RabController::class, 'buat_po_khs']);
Route::post('simpan-po-khs', [RabController::class, 'simpan_po_khs']);
Route::resource('po-khs', RabController::class);
Route::get('export-pdf-khs/{id}', [RabController::class, 'export_pdf_khs']);
Route::get('preview-pdf-khs/{id}', [RabController::class, 'preview_pdf_khs']);
Route::get('/search-pokhs', [RabController::class, 'searchpokhs']);
Route::post('/getAddendum', [RabController::class, 'getAddendum']);
Route::get('/getRedaksi', [RabController::class, 'getRedaksi']);
Route::post('/getDeskripsi', [RabController::class, 'getDeskripsi']);

Route::resource('prk', PrkController::class);
Route::any('prk/filter', [PrkController::class, 'filterprk']);
Route::get('/search-prk', [PrkController::class, 'searchprk']);
Route::resource('skk', SkkController::class);
Route::get('/search-skk', [SkkController::class, 'searchskk']);
Route::post('getSKK', [SkkController::class, 'getSKK']);
Route::post('getCategory', [SkkController::class, 'getCategory']);
Route::post('getItem', [SkkController::class, 'getItem']);
Route::post('getKontrakInduk', [SkkController::class, 'getKontrakInduk']);
Route::post('getKontrak_Induk', [SkkController::class, 'getKontrak_Induk']);


Route::resource('hpe', HpeController::class);

Route::resource('surat', PdfkhsController::class);

// Route::view('products', 'layouts.main', [
// 'data' => App\Http\Controllers\MainController::all()
// ]);{{  }}

//Non-PO
Route::resource('non-po', NonPOController::class);
Route::get('non-po/buat-non-po', [NonPOController::class, 'buat_non_po']);
Route::post('simpan-non-po', [NonPOController::class, 'simpan_non_po']);
