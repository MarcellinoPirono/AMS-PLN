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
use App\Http\Controllers\NonPoHpeController;
use App\Http\Controllers\JenisKhsController;
use App\Http\Controllers\KontrakIndukController;
use App\Http\Controllers\KhsController;
use App\Http\Controllers\PdfkhsController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\KlasifikasiPaketController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AddendumController;
use App\Http\Controllers\RedaksiController;
use App\Http\Controllers\NonPOController;
use App\Http\Controllers\PaketPekerjaanController;
use App\Http\Controllers\PejabatController;
use App\Http\Controllers\PpnController;
use App\Http\Controllers\ImporExcelController;
use App\Http\Controllers\CetakNonTkdnController;
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

Route::get('/', [MainController::class, 'index'])->middleware('auth');

Route::get('/dashboard', [MainController::class, 'index'])->name('dashboard')->middleware('auth');/*->middleware('admin')*/;

//LOGIN
Route::get('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('categories', ItemRincianIndukController::class)->middleware('auth');
Route::get('/search-categories', [ItemRincianIndukController::class, 'searchcategories']);


//KHS
Route::get('item-khs/{jenis_khs}', [RincianIndukController::class, 'jenis_khs'])->middleware('auth');;
Route::get('item-khs/{jenis_khs}/create', [RincianIndukController::class, 'create'])->middleware('auth');;
Route::post('item-khs/{jenis_khs}/create', [RincianIndukController::class, 'store'])->middleware('auth');;
Route::post('item-khs/{jenis_khs}/import', [RincianIndukController::class, 'import'])->middleware('auth');;
Route::get('item-khs/{jenis_khs}/export', [RincianIndukController::class, 'export'])->middleware('auth');;
Route::get('item-khs/{jenis_khs}/{id}/edit', [RincianIndukController::class, 'edit'])->name('item-khs.edit')->middleware('auth');;
Route::get('item-khs/{jenis_khs}/{id}', [RincianIndukController::class, 'destroy'])->middleware('auth');;
Route::any('item-khs/{jenis_khs}/filter', [RincianIndukController::class, 'filteritem'])->middleware('auth');;
Route::put('item-khs/{jenis_khs}/{id}/edit', [RincianIndukController::class, 'update'])->middleware('auth');;
// Route::get('item-khs/{jenis_khs}', [ImporExcelController::class, 'index']);
// Route::get('item-khs/{jenis_khs}/create', [RincianIndukController::class, 'create']);
// Route::post('item-khs/{jenis_khs}/create', [RincianIndukController::class, 'store']);
// Route::get('item-khs/{jenis_khs}/{id}/edit', [RincianIndukController::class, 'edit'])->name('item-khs.edit');
// Route::get('item-khs/{jenis_khs}/{id}', [RincianIndukController::class, 'destroy']);
// Route::any('item-khs/{jenis_khs}/filter', [RincianIndukController::class, 'filteritem']);
// Route::put('item-khs/{jenis_khs}/{id}/edit', [RincianIndukController::class, 'update']);


// Route::put('item-khs/{jenis_khs}/{id}/update', [RincianIndukController::class, 'update']);


// Route::resource('item-khs', RincianIndukController::class);

Route::resource('jenis-khs', KhsController::class)->middleware('auth');
Route::get('/search-jenis-khs', [KhsController::class, 'searchjeniskhs'])->middleware('auth');
Route::post('/checkJenisKhs', [KhsController::class, 'checkJenisKhs']);
Route::post('/checkJenisKhs/edit', [KhsController::class, 'checkJenisKhs_edit'])->middleware('auth');;

//Vendor KHS
Route::get('/vendor-khs/create-xlsx', [VendorController::class, 'create_xlsx'])->middleware('auth');;
Route::post('vendor-khs/import', [VendorController::class, 'import'])->middleware('auth');;
Route::post('/checkVendor', [VendorController::class, 'checkVendor'])->middleware('auth');;
Route::resource('vendor-khs', VendorController::class)->middleware('auth');
// Route::resource('vendor-khs', VendorController::class);
Route::get('/search-vendor', [VendorController::class, 'searchvendor'])->middleware('auth');;

//Kontrak Induk KHS
Route::get('/kontrak-induk-khs/create-xlsx', [KontrakIndukController::class, 'create_xlsx'])->middleware('auth');;
Route::post('kontrak-induk-khs/import', [KontrakIndukController::class, 'import'])->middleware('auth');;
Route::post('/checkKontrakInduk', [KontrakIndukController::class, 'checkKontrakInduk'])->middleware('auth');
Route::resource('kontrak-induk-khs', KontrakIndukController::class)->middleware('auth');
Route::any('kontrak-induk-khs/filter', [KontrakIndukController::class, 'filterkontrakinduk'])->middleware('auth');
Route::get('/search-kontrak-induk', [KontrakIndukController::class, 'searchkontrakinduk'])->middleware('auth');

//Addendum KHS
Route::get('/addendum-khs/create-xlsx', [AddendumController::class, 'create_xlsx'])->middleware('auth');
Route::post('addendum-khs/import', [AddendumController::class, 'import'])->middleware('auth');
Route::post('/checkAddendum', [AddendumController::class, 'checkAddendum'])->middleware('auth');
Route::resource('addendum-khs', AddendumController::class)->middleware('auth');
Route::any('addendum-khs/filter', [AddendumController::class, 'filteraddendum'])->middleware('auth');
Route::get('/search-addendum-khs', [AddendumController::class, 'searchaddendumkhs'])->middleware('auth');
// Route::post('getNoKontrakInduk', [AddendumController::class, 'getNoKontrakInduk']);
// Route::resource('addendum-khs ', AddendumController::class);

//Redaksi KHS
Route::resource('redaksi-khs', RedaksiController::class)->middleware('auth');

//Pejabat
Route::resource('pejabat', PejabatController::class)->middleware('auth');
Route::get('/search-pejabat', [PejabatController::class, 'searchpejabat'])->middleware('auth');

Route::get('ppn', [PpnController::class, 'index'])->middleware('auth');
Route::get('ppn/{ppn}/edit', [PpnController::class, 'edit'])->middleware('auth');
Route::put('ppn/{ppn}', [PpnController::class, 'update'])->middleware('auth');
// Route::resource('ppn', PpnController::class);
// Route::get('/search-pejabat', [PejabatController::class, 'searchpejabat'])->middleware('auth');

//MENU
Route::get('/menu-item-khs', [MenuController::class, 'MenuItemKHS'])->middleware('auth');
Route::get('/menu-paket-pekerjaan', [MenuController::class, 'PaketPekerjaan'])->middleware('auth');
Route::get('/menu-klasifikasi-paket-pekerjaan', [MenuController::class, 'KlasifikasiPaketPekerjaan'])->middleware('auth');


Route::any('rincian/filter', [RincianIndukController::class, 'filter'])->middleware('auth');
Route::get('/search-rincian', [RincianIndukController::class, 'searchRincian'])->middleware('auth');
Route::get('deleteitem/{id}', [RincianIndukController::class, 'destroy'])->middleware('auth');
Route::post('/checkItem', [RincianIndukController::class, 'checkItem'])->middleware('auth');

//PO KHS
Route::get('po-khs/buat-po', [RabController::class, 'buat_po_khs'])->middleware('auth');
Route::get('po-khs/edit-po/{slug}', [RabController::class, 'edit_po_khs'])->middleware('auth');
Route::put('po-khs/edit-po/{slug}', [RabController::class, 'update_po_khs'])->middleware('auth');
Route::post('simpan-po-khs', [RabController::class, 'simpan_po_khs'])->middleware('auth');
Route::post('/checkPO', [RabController::class, 'checkPO'])->middleware('auth');
Route::resource('po-khs', RabController::class)->middleware('auth');;
Route::get('export-pdf-khs/{slug}', [RabController::class, 'export_pdf_khs'])->middleware('auth');
Route::get('preview-pdf-khs/{slug}', [RabController::class, 'preview_pdf_khs'])->middleware('auth');
Route::get('/search-pokhs', [RabController::class, 'searchpokhs'])->middleware('auth');
Route::post('/getAddendum', [RabController::class, 'getAddendum'])->middleware('auth');
Route::post('/getVendor', [RabController::class, 'getVendor'])->middleware('auth');
Route::get('/getRedaksi', [RabController::class, 'getRedaksi'])->middleware('auth');
Route::post('/getDeskripsi', [RabController::class, 'getDeskripsi'])->middleware('auth');
Route::post('/getSubDeskripsi', [RabController::class, 'getSubDeskripsi'])->middleware('auth');

Route::resource('prk', PrkController::class)->middleware('auth');
Route::any('prk/filter', [PrkController::class, 'filterprk'])->middleware('auth');
Route::get('/search-prk', [PrkController::class, 'searchprk'])->middleware('auth');
Route::post('/checkPRK', [PrkController::class, 'checkPRK'])->middleware('auth');
Route::resource('skk', SkkController::class)->middleware('auth');
Route::get('/search-skk', [SkkController::class, 'searchskk'])->middleware('auth');
Route::post('/getSKK', [SkkController::class, 'getSKK'])->middleware('auth');
Route::post('/getPRK', [SkkController::class, 'getPRK'])->middleware('auth');
Route::post('/getCategory', [SkkController::class, 'getCategory'])->middleware('auth');
Route::post('/getItem', [SkkController::class, 'getItem'])->middleware('auth');
Route::post('/getKontrakInduk', [SkkController::class, 'getKontrakInduk'])->middleware('auth');
Route::post('/getKontrak_Induk', [SkkController::class, 'getKontrak_Induk'])->middleware('auth');
Route::post('/checkSKK', [SkkController::class, 'checkSKK'])->middleware('auth');
// Route::post('skk/check-no-skk.php');


//Paket Pekerjaan
Route::get('paket-pekerjaan/{jenis_khs}', [PaketPekerjaanController::class, 'jenis_khs'])->middleware('auth');
// Route::get('paket-pekerjaan/{jenis_khs}/create', [PaketPekerjaanController::class, 'create']);
Route::get('paket-pekerjaan/{jenis_khs}/create', [PaketPekerjaanController::class, 'DataTable'])->name('paket-pekerjaan.data')->middleware('auth');
Route::post('paket-pekerjaan/{jenis_khs}/create', [PaketPekerjaanController::class, 'store'])->middleware('auth');
Route::post('paket-pekerjaan/{jenis_khs}/import', [PaketPekerjaanController::class, 'import'])->middleware('auth');
Route::post('/checkPaketPekerjaan', [PaketPekerjaanController::class, 'checkPaketPekerjaan'])->middleware('auth');
Route::get('paket-pekerjaan/{jenis_khs}/{slug}/edit', [PaketPekerjaanController::class, 'edit'])->middleware('auth')->name('paket-pekerjaan.edit');
Route::delete('paket-pekerjaan/{jenis_khs}/{slug}', [PaketPekerjaanController::class, 'destroy'])->middleware('auth');
Route::any('paket-pekerjaan/{jenis_khs}/filter', [PaketPekerjaanController::class, 'filterPaket'])->middleware('auth');
Route::put('paket-pekerjaan/{jenis_khs}/{slug}/edit', [PaketPekerjaanController::class, 'update'])->middleware('auth');

Route::post('/getPaket', [PaketPekerjaanController::class, 'getPaketPekerjaan'])->middleware('auth');
Route::post('/change-paket', [PaketPekerjaanController::class, 'changePaket'])->middleware('auth');
Route::post('/change-paket2', [PaketPekerjaanController::class, 'changePaket2'])->middleware('auth');
Route::post('/gantiPaket', [PaketPekerjaanController::class, 'ganti_paket'])->middleware('auth');
// Route::get('/paket-pekerjaan/createSlug', [PaketPekerjaanController::class, 'checkSlug'])->middleware('auth');

//Paket Pekerjaan
Route::get('klasifikasi-paket-pekerjaan/{jenis_khs}', [KlasifikasiPaketController::class, 'index'])->middleware('auth');
// Route::get('klasifikasi-paket-pekerjaan/{jenis_khs}/create', [KlasifikasiPaketController::class, 'create'])->middleware('auth');
Route::get('klasifikasi-paket-pekerjaan/{jenis_khs}/create', [KlasifikasiPaketController::class, 'create'])->middleware('auth');
Route::post('klasifikasi-paket-pekerjaan/{jenis_khs}/create', [KlasifikasiPaketController::class, 'store'])->middleware('auth');
Route::post('klasifikasi-paket-pekerjaan/{jenis_khs}/import', [KlasifikasiPaketController::class, 'import'])->middleware('auth');
Route::get('klasifikasi-paket-pekerjaan/{jenis_khs}/{id}/edit', [KlasifikasiPaketController::class, 'edit'])->middleware('auth')->name('klasifikasi-paket-pekerjaan.edit');
Route::get('klasifikasi-paket-pekerjaan/{jenis_khs}/{id}', [KlasifikasiPaketController::class, 'destroy'])->middleware('auth');
Route::any('klasifikasi-paket-pekerjaan/{jenis_khs}/filter', [KlasifikasiPaketController::class, 'filterPaket'])->middleware('auth');
Route::put('klasifikasi-paket-pekerjaan/{jenis_khs}/{id}/edit', [KlasifikasiPaketController::class, 'update'])->middleware('auth');

// Route::get('/getPaket', [KlasifikasiPaketController::class, 'getPaketPekerjaan'])->middleware('auth');





// Route::view('products', 'layouts.main', [
// 'data' => App\Http\Controllers\MainController::all()
// ]);{{  }}

//Non-PO
Route::get('non-po/buat-non-po', [NonPOController::class, 'buat_non_po'])->middleware('auth');
Route::post('simpan-non-po', [NonPOController::class, 'simpan_non_po'])->middleware('auth');
Route::get('non-po/export-pdf-khs/{id}', [NonPOController::class, 'export_pdf_khs'])->middleware('auth');
Route::get('download-non-po/{id}', [NonPOController::class, 'download'])->middleware('auth');
Route::resource('non-po', NonPOController::class)->middleware('auth');

Route::get('non-po-hpe/{id}/buat-non-po-hpe', [NonPoHpeController::class, 'buat_non_po_hpe'])->middleware('auth');
Route::post('simpan-non-po-hpe', [NonPoHpeController::class, 'simpan_non_po_hpe'])->middleware('auth');
Route::resource('non-po-hpe', NonPoHpeController::class)->middleware('auth');
// Route::resource('non-po-hpe', NonPOHPEController::class);

Route::get('hpe/export-pdf-khs/{id}', [HpeController::class, 'export_pdf_khs'])->middleware('auth');
Route::resource('hpe', HpeController::class)->middleware('auth');

Route::get('download-hpe/{id}', [HpeController::class, 'download'])->middleware('auth');



//TKDN
Route::post('cetak-pdf-tkdn', [PdfkhsController::class, 'cetak_tkdn_lampiran'])->middleware('auth');
Route::post('cetak-tkdn', [PdfkhsController::class, 'cetak_tkdn_non_lampiran'])->middleware('auth');
Route::post('cetak-paket-pdf-tkdn', [PdfkhsController::class, 'cetak_paket_tkdn_lampiran'])->middleware('auth');
Route::post('cetak-paket-tkdn-non-lampiran', [PdfkhsController::class, 'cetak_paket_tkdn_non_lampiran'])->middleware('auth');



//NON-TKDN
Route::post('cetak-paket-pdf-non-tkdn', [CetakNonTkdnController::class, 'cetak_paket_non_tkdn_lampiran'])->middleware('auth');
Route::post('cetak-paket-non-tkdn-non-lampiran', [CetakNonTkdnController::class, 'cetak_paket_non_tkdn_non_lampiran'])->middleware('auth');
Route::post('cetak-non-tkdn-pdf', [CetakNonTkdnController::class, 'cetak_non_tkdn_lampiran'])->middleware('auth');
Route::post('cetak-non-tkdn', [CetakNonTkdnController::class, 'cetak_non_tkdn_non_lampiran'])->middleware('auth');


Route::get('download/{slug}', [PdfkhsController::class, 'download'])->middleware('auth');

//USER
// Route::resource('user', UserController::class);

Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index')->name('index')->middleware('auth');
    Route::get('/user/create', 'create')->name('user.create')->middleware('auth');
    Route::post('/edit-profile', 'edit')->name('user.edit_profile')->middleware('auth');
    Route::post('/edit-profile-update', 'update')->name('user.update')->middleware('auth');
    Route::get('/edit-password', 'edit_password')->name('user.edit_password')->middleware('auth');
    Route::post('/check-password', 'check_password')->name('user.check_password')->middleware('auth');
    Route::post('/user', 'store')->name('user')->middleware('auth');
    Route::post('/pic_profile', 'simpan_gambar')->name('pic_profile')->middleware('auth');
    Route::delete('/deleteuser/{id}', 'destroy')->name('hapus')->middleware('auth');
});

Route::post('/checkUsername', [UserController::class, 'checkUsername'])->middleware('auth');

