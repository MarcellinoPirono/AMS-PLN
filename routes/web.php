<?php

use App\Models\Rab;
use App\Http\Controllers\ItemRincianInduk;
use App\Http\Controllers\ItemRincianIndukController;
use App\Http\Controllers\RedaksiNotaDinasController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RabController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PrkController;
use App\Http\Controllers\SkkController;
use App\Http\Controllers\RincianIndukController;
use App\Http\Controllers\HpeController;
use App\Http\Controllers\PengesahanHpeController;
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

Route::get('/', [MainController::class, 'index'])->middleware('SupervisorMiddleware');

Route::get('/dashboard', [MainController::class, 'index'])->name('dashboard')->middleware('SupervisorMiddleware');/*->middleware('admin')*/;

//LOGIN
Route::get('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('categories', ItemRincianIndukController::class)->middleware('auth');
Route::get('/search-categories', [ItemRincianIndukController::class, 'searchcategories']);


//KHS
Route::get('item-khs/{jenis_khs}', [RincianIndukController::class, 'jenis_khs'])->middleware('Manager');
Route::get('item-khs/{jenis_khs}/create', [RincianIndukController::class, 'create'])->middleware('Manager');
Route::post('item-khs/{jenis_khs}/create', [RincianIndukController::class, 'store'])->middleware('Manager');
Route::post('item-khs/{jenis_khs}/import', [RincianIndukController::class, 'import'])->middleware('Manager');
Route::get('item-khs/{jenis_khs}/export', [RincianIndukController::class, 'export'])->middleware('Manager');
Route::get('item-khs/{jenis_khs}/{id}/edit', [RincianIndukController::class, 'edit'])->name('item-khs.edit')->middleware('Manager');
Route::get('item-khs/{jenis_khs}/{id}', [RincianIndukController::class, 'destroy'])->middleware('Manager');
Route::any('item-khs/{jenis_khs}/filter', [RincianIndukController::class, 'filteritem'])->middleware('Manager');
Route::put('item-khs/{jenis_khs}/{id}/edit', [RincianIndukController::class, 'update'])->middleware('Manager');
// Route::get('item-khs/{jenis_khs}', [ImporExcelController::class, 'index']);
// Route::get('item-khs/{jenis_khs}/create', [RincianIndukController::class, 'create']);
// Route::post('item-khs/{jenis_khs}/create', [RincianIndukController::class, 'store']);
// Route::get('item-khs/{jenis_khs}/{id}/edit', [RincianIndukController::class, 'edit'])->name('item-khs.edit');
// Route::get('item-khs/{jenis_khs}/{id}', [RincianIndukController::class, 'destroy']);
// Route::any('item-khs/{jenis_khs}/filter', [RincianIndukController::class, 'filteritem']);
// Route::put('item-khs/{jenis_khs}/{id}/edit', [RincianIndukController::class, 'update']);


// Route::put('item-khs/{jenis_khs}/{id}/update', [RincianIndukController::class, 'update']);


// Route::resource('item-khs', RincianIndukController::class);

Route::resource('jenis-khs', KhsController::class)->middleware('Manager');
Route::get('/search-jenis-khs', [KhsController::class, 'searchjeniskhs'])->middleware('Manager');
Route::post('/checkJenisKhs', [KhsController::class, 'checkJenisKhs']);
Route::post('/checkJenisKhs/edit', [KhsController::class, 'checkJenisKhs_edit'])->middleware('Manager');

//Vendor KHS
Route::get('/vendor-khs/create-xlsx', [VendorController::class, 'create_xlsx'])->middleware('Manager');
Route::post('vendor-khs/import', [VendorController::class, 'import'])->middleware('Manager');
Route::post('/checkVendor', [VendorController::class, 'checkVendor'])->middleware('Manager');
Route::post('/checkVendor_edit', [VendorController::class, 'checkVendor_edit'])->middleware('Manager');
Route::resource('vendor-khs', VendorController::class)->middleware('Manager');
// Route::resource('vendor-khs', VendorController::class);
Route::get('/search-vendor', [VendorController::class, 'searchvendor'])->middleware('Manager');

//Kontrak Induk KHS
Route::get('/kontrak-induk-khs/create-xlsx', [KontrakIndukController::class, 'create_xlsx'])->middleware('Manager');
Route::post('kontrak-induk-khs/import', [KontrakIndukController::class, 'import'])->middleware('Manager');
Route::post('/checkKontrakInduk', [KontrakIndukController::class, 'checkKontrakInduk'])->middleware('Manager');
Route::post('/checkKontrakInduk_edit', [KontrakIndukController::class, 'checkKontrakInduk_edit'])->middleware('Manager');
Route::resource('kontrak-induk-khs', KontrakIndukController::class)->middleware('Manager');
Route::any('kontrak-induk-khs/filter', [KontrakIndukController::class, 'filterkontrakinduk'])->middleware('Manager');
Route::get('/search-kontrak-induk', [KontrakIndukController::class, 'searchkontrakinduk'])->middleware('Manager');

//Addendum KHS
Route::get('/addendum-khs/create-xlsx', [AddendumController::class, 'create_xlsx'])->middleware('Manager');
Route::get('download-addendum/{id}', [AddendumController::class, 'download_addendum'])->middleware('Manager');
Route::post('addendum-khs/import', [AddendumController::class, 'import'])->middleware('Manager');
Route::post('addendum-khs/{id}/edit', [AddendumController::class, 'update'])->middleware('Manager');
Route::post('/checkAddendum', [AddendumController::class, 'checkAddendum'])->middleware('Manager');
Route::post('/checkAddendum_edit', [AddendumController::class, 'checkAddendum_edit'])->middleware('Manager');
Route::resource('addendum-khs', AddendumController::class)->middleware('Manager');
Route::any('addendum-khs/filter', [AddendumController::class, 'filteraddendum'])->middleware('Manager');
Route::get('/search-addendum-khs', [AddendumController::class, 'searchaddendumkhs'])->middleware('Manager');
// Route::post('getNoKontrakInduk', [AddendumController::class, 'getNoKontrakInduk']);
// Route::resource('addendum-khs ', AddendumController::class);

//Redaksi KHS
Route::resource('redaksi-khs', RedaksiController::class)->middleware('Manager');
Route::post('/checkRedaksi', [RedaksiController::class, 'checkRedaksi'])->middleware('Manager');
Route::post('/checkRedaksi_edit', [RedaksiController::class, 'checkRedaksi_edit'])->middleware('Manager');


//Redaksi KHS
Route::resource('redaksi-nota-dinas', RedaksiNotaDinasController::class)->middleware('Manager');
Route::post('/checkRedaksiNota', [RedaksiNotaDinasController::class, 'checkRedaksi'])->middleware('Manager');
Route::post('/checkRedaksi_edit_nota', [RedaksiNotaDinasController::class, 'checkRedaksi_edit'])->middleware('Manager');

//Pejabat
Route::resource('pejabat', PejabatController::class)->middleware('Manager');
Route::post('/checkPejabat', [PejabatController::class, 'checkPejabat'])->middleware('Manager');
Route::post('/checkPejabat_edit', [PejabatController::class, 'checkPejabat_edit'])->middleware('Manager');
Route::get('/search-pejabat', [PejabatController::class, 'searchpejabat'])->middleware('Manager');
Route::get('ppn', [PpnController::class, 'index'])->middleware('Manager');
Route::get('ppn/{ppn}/edit', [PpnController::class, 'edit'])->middleware('Manager');
Route::put('ppn/{ppn}', [PpnController::class, 'update'])->middleware('Manager');
// Route::resource('ppn', PpnController::class);
// Route::get('/search-pejabat', [PejabatController::class, 'searchpejabat'])->middleware('Manager');

//MENU
Route::get('/menu-item-khs', [MenuController::class, 'MenuItemKHS'])->middleware('Manager');
Route::get('/menu-paket-pekerjaan', [MenuController::class, 'PaketPekerjaan'])->middleware('Manager');
Route::get('/menu-klasifikasi-paket-pekerjaan', [MenuController::class, 'KlasifikasiPaketPekerjaan'])->middleware('Manager');


Route::any('rincian/filter', [RincianIndukController::class, 'filter'])->middleware('Manager');
Route::get('/search-rincian', [RincianIndukController::class, 'searchRincian'])->middleware('Manager');
Route::get('deleteitem/{id}', [RincianIndukController::class, 'destroy'])->middleware('Manager');
Route::post('/checkItem', [RincianIndukController::class, 'checkItem'])->middleware('Manager');
Route::post('/checkItem_edit', [RincianIndukController::class, 'checkItem_edit'])->middleware('Manager');

//PO KHS
Route::get('po-khs/buat-po', [RabController::class, 'buat_po_khs'])->middleware('SupervisorMiddleware');
Route::get('po-khs/edit-po/{slug}', [RabController::class, 'edit_po_khs'])->middleware('SupervisorMiddleware');
Route::put('po-khs/edit-po/{slug}', [RabController::class, 'update_po_khs'])->middleware('SupervisorMiddleware');
Route::post('simpan-po-khs', [RabController::class, 'simpan_po_khs'])->middleware('SupervisorMiddleware');
Route::post('/checkPO', [RabController::class, 'checkPO'])->middleware('SupervisorMiddleware');
Route::get('/po-khs', [RabController::class, 'index'])->middleware('SupervisorMiddleware');
Route::get('export-pdf-khs/{slug}', [RabController::class, 'export_pdf_khs'])->middleware('SupervisorMiddleware');
Route::get('preview-pdf-khs/{slug}', [RabController::class, 'preview_pdf_khs'])->middleware('SupervisorMiddleware');
Route::get('/search-pokhs', [RabController::class, 'searchpokhs'])->middleware('SupervisorMiddleware');
Route::post('/getAddendum', [RabController::class, 'getAddendum'])->middleware('SupervisorMiddleware');
Route::post('/getVendor', [RabController::class, 'getVendor'])->middleware('SupervisorMiddleware');
Route::get('/getRedaksi', [RabController::class, 'getRedaksi'])->middleware('SupervisorMiddleware');
Route::post('/getDeskripsi', [RabController::class, 'getDeskripsi'])->middleware('SupervisorMiddleware');
Route::post('/getSubDeskripsi', [RabController::class, 'getSubDeskripsi'])->middleware('SupervisorMiddleware');
Route::get('/upload-po', [RabController::class, 'upload_po_khs'])->middleware('Manager');

//PRK
Route::resource('prk', PrkController::class)->middleware('Keuangan');
Route::any('prk/filter', [PrkController::class, 'filterprk'])->middleware('Keuangan');
Route::get('/search-prk', [PrkController::class, 'searchprk'])->middleware('Keuangan');
Route::post('/checkPRK', [PrkController::class, 'checkPRK'])->middleware('Keuangan');
Route::post('/checkPRK_edit', [PrkController::class, 'checkPRK_edit'])->middleware('Keuangan');


Route::resource('skk', SkkController::class)->middleware('Keuangan');
Route::get('/search-skk', [SkkController::class, 'searchskk'])->middleware('Keuangan');
Route::post('/getSKK', [SkkController::class, 'getSKK'])->middleware('SupervisorMiddleware');
Route::post('/getPRK', [SkkController::class, 'getPRK'])->middleware('SupervisorMiddleware');
Route::post('/getCategory', [SkkController::class, 'getCategory'])->middleware('SupervisorMiddleware');
Route::post('/getItem', [SkkController::class, 'getItem'])->middleware('SupervisorMiddleware');
Route::post('/getKontrakInduk', [SkkController::class, 'getKontrakInduk'])->middleware('SupervisorMiddleware');
Route::post('/getKontrak_Induk', [SkkController::class, 'getKontrak_Induk'])->middleware('SupervisorMiddleware');
Route::post('/checkSKK', [SkkController::class, 'checkSKK'])->middleware('SupervisorMiddleware');
Route::post('/checkSKK_edit', [SkkController::class, 'checkSKK_edit'])->middleware('Keuangan');
// Route::post('skk/check-no-skk.php');


//Paket Pekerjaan
Route::get('paket-pekerjaan/{jenis_khs}', [PaketPekerjaanController::class, 'jenis_khs'])->middleware('Manager');
// Route::get('paket-pekerjaan/{jenis_khs}/create', [PaketPekerjaanController::class, 'create']);
Route::get('paket-pekerjaan/{jenis_khs}/create', [PaketPekerjaanController::class, 'DataTable'])->name('paket-pekerjaan.data')->middleware('Manager');
Route::post('paket-pekerjaan/{jenis_khs}/create', [PaketPekerjaanController::class, 'store'])->middleware('Manager');
Route::post('paket-pekerjaan/{jenis_khs}/import', [PaketPekerjaanController::class, 'import'])->middleware('Manager');
Route::post('/checkPaketPekerjaan', [PaketPekerjaanController::class, 'checkPaketPekerjaan'])->middleware('Manager');
Route::post('/checkPaketPekerjaan_edit', [PaketPekerjaanController::class, 'checkPaketPekerjaan_edit'])->middleware('Manager');
Route::get('paket-pekerjaan/{jenis_khs}/{slug}/edit', [PaketPekerjaanController::class, 'edit'])->middleware('Manager')->name('paket-pekerjaan.edit');
Route::delete('paket-pekerjaan/{jenis_khs}/{slug}', [PaketPekerjaanController::class, 'destroy'])->middleware('Manager');
Route::any('paket-pekerjaan/{jenis_khs}/filter', [PaketPekerjaanController::class, 'filterPaket'])->middleware('Manager');
Route::put('paket-pekerjaan/{jenis_khs}/{slug}/edit', [PaketPekerjaanController::class, 'update'])->middleware('Manager');

Route::post('/getPaket', [PaketPekerjaanController::class, 'getPaketPekerjaan'])->middleware('SupervisorMiddleware');
Route::post('/change-paket', [PaketPekerjaanController::class, 'changePaket'])->middleware('SupervisorMiddleware');
Route::post('/change-paket2', [PaketPekerjaanController::class, 'changePaket2'])->middleware('SupervisorMiddleware');
Route::post('/gantiPaket', [PaketPekerjaanController::class, 'ganti_paket'])->middleware('SupervisorMiddleware');
// Route::get('/paket-pekerjaan/createSlug', [PaketPekerjaanController::class, 'checkSlug'])->middleware('Manager');

//Paket Pekerjaan


// Route::get('/getPaket', [KlasifikasiPaketController::class, 'getPaketPekerjaan'])->middleware('Manager');





// Route::view('products', 'layouts.main', [
// 'data' => App\Http\Controllers\MainController::all()
// ]);{{  }}

//Non-PO
Route::get('non-po/buat-non-po', [NonPOController::class, 'buat_non_po'])->middleware('SupervisorMiddleware');
Route::post('simpan-non-po', [NonPOController::class, 'simpan_non_po'])->middleware('SupervisorMiddleware');
Route::post('/checkNotaDinas', [NonPOController::class, 'checkNotaDinas'])->middleware('SupervisorMiddleware');
Route::get('download-non-po/{slug}', [NonPOController::class, 'download_nonpo'])->middleware('SupervisorMiddleware');
Route::get('preview-non-po/{slug}', [NonPOController::class, 'preview_non_po'])->middleware('SupervisorMiddleware');
Route::resource('non-po', NonPOController::class)->middleware('SupervisorMiddleware');

Route::get('buat-non-po-hpe/{slug}', [NonPoHpeController::class, 'buat_non_po_hpe'])->middleware('SupervisorMiddleware');
Route::get('edit-hpe/{slug}', [NonPoHpeController::class, 'edit_hpe'])->middleware('SupervisorMiddleware');
Route::post('/getDeskripsiNota', [NonPoHpeController::class, 'getDeskripsi'])->middleware('SupervisorMiddleware');
Route::post('simpan-non-po-hpe', [NonPoHpeController::class, 'simpan_non_po_hpe'])->middleware('SupervisorMiddleware');
Route::post('simpan-edit-hpe', [NonPoHpeController::class, 'simpan_edit_hpe'])->middleware('SupervisorMiddleware');
Route::get('preview-hpe/{slug}', [NonPoHpeController::class, 'preview_hpe'])->middleware('SupervisorMiddleware');
Route::get('download-hpe/{slug}', [NonPoHpeController::class, 'download'])->middleware('SupervisorMiddleware');
Route::get('download-test/{slug}', [NonPoHpeController::class, 'download_test'])->middleware('SupervisorMiddleware');


Route::resource('non-po-hpe', NonPoHpeController::class)->middleware('SupervisorMiddleware');
// Route::resource('non-po-hpe', NonPOHPEController::class);

Route::get('hpe/export-pdf-khs/{id}', [HpeController::class, 'export_pdf_khs'])->middleware('SupervisorMiddleware');
Route::resource('hpe', HpeController::class)->middleware('SupervisorMiddleware');

Route::resource('pengesahan-hpe', PengesahanHpeController::class)->middleware('SupervisorMiddleware');

Route::get('download-hpe/{id}', [HpeController::class, 'download'])->middleware('SupervisorMiddleware');



//TKDN
Route::post('cetak-pdf-tkdn', [PdfkhsController::class, 'cetak_tkdn_lampiran'])->middleware('SupervisorMiddleware');
Route::post('cetak-tkdn', [PdfkhsController::class, 'cetak_tkdn_non_lampiran'])->middleware('SupervisorMiddleware');
Route::post('cetak-paket-pdf-tkdn', [PdfkhsController::class, 'cetak_paket_tkdn_lampiran'])->middleware('SupervisorMiddleware');
Route::post('cetak-paket-tkdn-non-lampiran', [PdfkhsController::class, 'cetak_paket_tkdn_non_lampiran'])->middleware('SupervisorMiddleware');



//NON-TKDN
Route::post('cetak-paket-pdf-non-tkdn', [CetakNonTkdnController::class, 'cetak_paket_non_tkdn_lampiran'])->middleware('SupervisorMiddleware');
Route::post('cetak-paket-non-tkdn-non-lampiran', [CetakNonTkdnController::class, 'cetak_paket_non_tkdn_non_lampiran'])->middleware('SupervisorMiddleware');
Route::post('cetak-non-tkdn-pdf', [CetakNonTkdnController::class, 'cetak_non_tkdn_lampiran'])->middleware('SupervisorMiddleware');
Route::post('cetak-non-tkdn', [CetakNonTkdnController::class, 'cetak_non_tkdn_non_lampiran'])->middleware('SupervisorMiddleware');


Route::get('download/{slug}', [PdfkhsController::class, 'download'])->middleware('SupervisorMiddleware');

//USER
// Route::resource('user', UserController::class);

Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index')->middleware('AdminMiddleware');
    Route::get('/user/create', 'create')->name('user.create')->middleware('AdminMiddleware');
    Route::post('/edit-profile', 'edit')->name('user.edit_profile')->middleware('SupervisorMiddleware');
    // Route::post('/user/{username}/edit', 'edit_admin')->middleware('AdminMiddleware');
    // Route::put('/user/{username}/edit', 'update_admin')->middleware('AdminMiddleware');
    Route::post('/edit-profile-update', 'update')->name('user.update')->middleware('SupervisorMiddleware');
    Route::get('/edit-password', 'edit_password')->name('user.edit_password')->middleware('SupervisorMiddleware');
    Route::post('/check-password', 'check_password')->name('user.check_password')->middleware('SupervisorMiddleware');
    Route::post('/password-lama', 'password_lama')->middleware('SupervisorMiddleware');
    Route::post('/user', 'store')->name('user')->middleware('AdminMiddleware');
    Route::post('/pic_profile', 'simpan_gambar')->name('pic_profile')->middleware('SupervisorMiddleware');
    Route::delete('/deleteuser/{id}', 'destroy')->name('hapus')->middleware('AdminMiddleware');
});

Route::fallback([UserController::class,'not_found']);

Route::post('/checkUsername', [UserController::class, 'checkUsername'])->middleware('SupervisorMiddleware');
Route::post('/konfirmasi', [RabController::class, 'setuju'])->middleware('Manager');
Route::post('/konfirmasi-non-po', [NonPoHpeController::class, 'setuju'])->middleware('Manager');
Route::post('/checkUsername_edit', [UserController::class, 'checkUsername_edit'])->middleware('SupervisorMiddleware');

