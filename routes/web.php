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
use App\Http\Controllers\KlasifikasiPaketController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AddendumController;
use App\Http\Controllers\RedaksiController;
use App\Http\Controllers\NonPOController;
use App\Http\Controllers\PaketPekerjaanController;
use App\Http\Controllers\PejabatController;
use App\Http\Controllers\ImporExcelController;
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
Route::post('item-khs/{jenis_khs}/import', [RincianIndukController::class, 'import']);
Route::get('item-khs/{jenis_khs}/export', [RincianIndukController::class, 'export']);
Route::get('item-khs/{jenis_khs}/{id}/edit', [RincianIndukController::class, 'edit'])->name('item-khs.edit');
Route::get('item-khs/{jenis_khs}/{id}', [RincianIndukController::class, 'destroy']);
Route::any('item-khs/{jenis_khs}/filter', [RincianIndukController::class, 'filteritem']);
Route::put('item-khs/{jenis_khs}/{id}/edit', [RincianIndukController::class, 'update']);
// Route::get('item-khs/{jenis_khs}', [ImporExcelController::class, 'index']);
// Route::get('item-khs/{jenis_khs}/create', [RincianIndukController::class, 'create']);
// Route::post('item-khs/{jenis_khs}/create', [RincianIndukController::class, 'store']);
// Route::get('item-khs/{jenis_khs}/{id}/edit', [RincianIndukController::class, 'edit'])->name('item-khs.edit');
// Route::get('item-khs/{jenis_khs}/{id}', [RincianIndukController::class, 'destroy']);
// Route::any('item-khs/{jenis_khs}/filter', [RincianIndukController::class, 'filteritem']);
// Route::put('item-khs/{jenis_khs}/{id}/edit', [RincianIndukController::class, 'update']);


// Route::put('item-khs/{jenis_khs}/{id}/update', [RincianIndukController::class, 'update']);


// Route::resource('item-khs', RincianIndukController::class);

Route::resource('jenis-khs', KhsController::class);
Route::get('/search-jenis-khs', [KhsController::class, 'searchjeniskhs']);

//Vendor KHS
Route::get('/vendor-khs/create-xlsx', [VendorController::class, 'create_xlsx']);
Route::post('vendor-khs/import', [VendorController::class, 'import']);
Route::resource('vendor-khs', VendorController::class);
// Route::resource('vendor-khs', VendorController::class);
Route::get('/search-vendor', [VendorController::class, 'searchvendor']);

//Kontrak Induk KHS
Route::get('/kontrak-induk-khs/create-xlsx', [KontrakIndukController::class, 'create_xlsx']);
Route::post('kontrak-induk-khs/import', [KontrakIndukController::class, 'import']);
Route::resource('kontrak-induk-khs', KontrakIndukController::class);
Route::any('kontrak-induk-khs/filter', [KontrakIndukController::class, 'filterkontrakinduk']);
Route::get('/search-kontrak-induk', [KontrakIndukController::class, 'searchkontrakinduk']);

//Addendum KHS
Route::get('/addendum-khs/create-xlsx', [AddendumController::class, 'create_xlsx']);
Route::post('addendum-khs/import', [AddendumController::class, 'import']);
Route::resource('addendum-khs', AddendumController::class);
Route::any('addendum-khs/filter', [AddendumController::class, 'filteraddendum']);
Route::get('/search-addendum-khs', [AddendumController::class, 'searchaddendumkhs']);
// Route::post('getNoKontrakInduk', [AddendumController::class, 'getNoKontrakInduk']);
// Route::resource('addendum-khs ', AddendumController::class);

//Redaksi KHS
Route::resource('redaksi-khs', RedaksiController::class);

//Pejabat
Route::resource('pejabat', PejabatController::class);
Route::get('/search-pejabat', [PejabatController::class, 'searchpejabat']);

//MENU
Route::get('/menu-item-khs', [MenuController::class, 'MenuItemKHS']);
Route::get('/menu-paket-pekerjaan', [MenuController::class, 'PaketPekerjaan']);
Route::get('/menu-klasifikasi-paket-pekerjaan', [MenuController::class, 'KlasifikasiPaketPekerjaan']);


Route::any('rincian/filter', [RincianIndukController::class, 'filter']);
Route::get('/search-rincian', [RincianIndukController::class, 'searchRincian']);

Route::get('deleteitem/{id}', [RincianIndukController::class, 'destroy']);

//PO KHS
Route::get('po-khs/buat-po', [RabController::class, 'buat_po_khs']);
Route::get('po-khs/edit-po/{id}', [RabController::class, 'edit_po_khs']);
Route::put('po-khs/edit-po/{id}', [RabController::class, 'update_po_khs']);
Route::post('simpan-po-khs', [RabController::class, 'simpan_po_khs']);
Route::resource('po-khs', RabController::class);
Route::get('export-pdf-khs/{id}', [RabController::class, 'export_pdf_khs']);
Route::get('preview-pdf-khs/{id}', [RabController::class, 'preview_pdf_khs']);
Route::get('/search-pokhs', [RabController::class, 'searchpokhs']);
Route::post('/getAddendum', [RabController::class, 'getAddendum']);
Route::post('/getVendor', [RabController::class, 'getVendor']);
Route::get('/getRedaksi', [RabController::class, 'getRedaksi']);
Route::post('/getDeskripsi', [RabController::class, 'getDeskripsi']);
Route::post('/getSubDeskripsi', [RabController::class, 'getSubDeskripsi']);

Route::resource('prk', PrkController::class);
Route::any('prk/filter', [PrkController::class, 'filterprk']);
Route::get('/search-prk', [PrkController::class, 'searchprk']);
Route::resource('skk', SkkController::class);
Route::get('/search-skk', [SkkController::class, 'searchskk']);
Route::post('/getSKK', [SkkController::class, 'getSKK']);
Route::post('/getPRK', [SkkController::class, 'getPRK']);
Route::post('/getCategory', [SkkController::class, 'getCategory']);
Route::post('/getItem', [SkkController::class, 'getItem']);
Route::post('/getKontrakInduk', [SkkController::class, 'getKontrakInduk']);
Route::post('/getKontrak_Induk', [SkkController::class, 'getKontrak_Induk']);


//Paket Pekerjaan
Route::get('paket-pekerjaan/{jenis_khs}', [PaketPekerjaanController::class, 'jenis_khs']);
// Route::get('paket-pekerjaan/{jenis_khs}/create', [PaketPekerjaanController::class, 'create']);
Route::get('paket-pekerjaan/{jenis_khs}/create', [PaketPekerjaanController::class, 'DataTable'])->name('paket-pekerjaan.data');
Route::post('paket-pekerjaan/{jenis_khs}/create', [PaketPekerjaanController::class, 'store']);
Route::post('paket-pekerjaan/{jenis_khs}/import', [PaketPekerjaanController::class, 'import']);
Route::get('paket-pekerjaan/{jenis_khs}/{slug}/edit', [PaketPekerjaanController::class, 'edit'])->name('paket-pekerjaan.edit');
Route::delete('paket-pekerjaan/{jenis_khs}/{slug}', [PaketPekerjaanController::class, 'destroy']);
Route::any('paket-pekerjaan/{jenis_khs}/filter', [PaketPekerjaanController::class, 'filterPaket']);
Route::put('paket-pekerjaan/{jenis_khs}/{slug}/edit', [PaketPekerjaanController::class, 'update']);

Route::post('/getPaket', [PaketPekerjaanController::class, 'getPaketPekerjaan']);
Route::post('/change-paket', [PaketPekerjaanController::class, 'changePaket']);
// Route::get('/paket-pekerjaan/createSlug', [PaketPekerjaanController::class, 'checkSlug']);

//Paket Pekerjaan
Route::get('klasifikasi-paket-pekerjaan/{jenis_khs}', [KlasifikasiPaketController::class, 'index']);
// Route::get('klasifikasi-paket-pekerjaan/{jenis_khs}/create', [KlasifikasiPaketController::class, 'create']);
Route::get('klasifikasi-paket-pekerjaan/{jenis_khs}/create', [KlasifikasiPaketController::class, 'create']);
Route::post('klasifikasi-paket-pekerjaan/{jenis_khs}/create', [KlasifikasiPaketController::class, 'store']);
Route::post('klasifikasi-paket-pekerjaan/{jenis_khs}/import', [KlasifikasiPaketController::class, 'import']);
Route::get('klasifikasi-paket-pekerjaan/{jenis_khs}/{id}/edit', [KlasifikasiPaketController::class, 'edit'])->name('klasifikasi-paket-pekerjaan.edit');
Route::get('klasifikasi-paket-pekerjaan/{jenis_khs}/{id}', [KlasifikasiPaketController::class, 'destroy']);
Route::any('klasifikasi-paket-pekerjaan/{jenis_khs}/filter', [KlasifikasiPaketController::class, 'filterPaket']);
Route::put('klasifikasi-paket-pekerjaan/{jenis_khs}/{id}/edit', [KlasifikasiPaketController::class, 'update']);

// Route::get('/getPaket', [KlasifikasiPaketController::class, 'getPaketPekerjaan']);



Route::resource('hpe', HpeController::class);

Route::resource('surat', PdfkhsController::class);

// Route::view('products', 'layouts.main', [
// 'data' => App\Http\Controllers\MainController::all()
// ]);{{  }}

//Non-PO
Route::get('non-po/buat-non-po', [NonPOController::class, 'buat_non_po']);
Route::post('simpan-non-po', [NonPOController::class, 'simpan_non_po']);
Route::get('non-po/export-pdf-khs/{id}', [NonPOController::class, 'export_pdf_khs']);
Route::resource('non-po', NonPOController::class);
