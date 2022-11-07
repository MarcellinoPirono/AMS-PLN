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

Route::resource('rincian', RincianIndukController::class);
Route::any('rincian/filter', [RincianIndukController::class, 'filter']);
Route::get('/search-rincian', [RincianIndukController::class, 'searchRincian']);

Route::get('deleteitem/{id}', [RincianIndukController::class, 'destroy']);

Route::resource('khs', RabController::class);
Route::get('/buat-kontrak', [RabController::class, 'buat_kontrak']);


Route::resource('skk', SkkController::class);
Route::post('getSKK', [SkkController::class, 'getSKK']);
Route::post('getCategory', [SkkController::class, 'getCategory']);
Route::post('getItem', [SkkController::class, 'getItem']);

Route::resource('prk', PrkController::class);
Route::get('deleteskk/{id}', [SkkController::class, 'destroy']);

Route::get('deleteprk/{id}', [PrkController::class, 'destroy']);

Route::resource('hpe', HpeController::class);

// Route::view('products', 'layouts.main', [
// 'data' => App\Http\Controllers\MainController::all()
// ]);
