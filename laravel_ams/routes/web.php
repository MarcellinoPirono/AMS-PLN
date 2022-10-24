<?php

use App\Models\Rab;
use App\Http\Controllers\ItemRincianInduk;
use App\Http\Controllers\ItemRincianIndukController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RabController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PrkController;
use App\Http\Controllers\RincianIndukController;
use App\Http\Controllers\SpkkController;
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
// Route::post('/addcategories', [ItemRincianIndukController::class, 'store']);
Route::get('delete/{id}', [ItemRincianIndukController::class, 'destroy']);
Route::resource('rincian', RincianIndukController::class);
Route::get('deleteitem/{id}', [RincianIndukController::class, 'destroy']);
Route::resource('rab', RabController::class);
Route::resource('spkk', SpkkController::class);
Route::resource('prk', PrkController::class);
