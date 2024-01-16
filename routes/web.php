<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes(
    [
        'register' => true,
        'reset' => false,
        'verify' => false,
    ]
);

Route::get('/dokumentasi', [App\Http\Controllers\DokumentasiController::class, 'index'])->name('dokumentasi');
Route::post('/dokumentasi', [App\Http\Controllers\DokumentasiController::class, 'store'])->name('dokumentasi.store');
Route::get('/dokumentasi/{id}', [App\Http\Controllers\DokumentasiController::class, 'show'])->name('dokumentasi.show');
Route::delete('/dokumentasi/{id}', [App\Http\Controllers\DokumentasiController::class, 'destroy'])->name('dokumentasi.destroy');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tes', [App\Http\Controllers\HomeController::class, 'tes'])->name('tes');


// Document Route
Route::resource('dokumen', DocumentController::class);


Route::get('/informasi', [App\Http\Controllers\InformasiController::class, 'index'])->name('indexinformasi');
Route::post('/addInformasi', [App\Http\Controllers\InformasiController::class, 'addInformasi'])->name('addInformasi');
Route::delete('/delInformasi/{id}', [App\Http\Controllers\InformasiController::class, 'deleteInformasi'])->name('deleteInformasi');
Route::get('/informasi/{id}', [App\Http\Controllers\InformasiController::class, 'informasiByID'])->name('informasiByID');


Route::get('/profile', [App\Http\Controllers\UserController::class, 'index'])->name('profile');
Route::get('/profile/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('editprofile');
Route::post('/profile/update', [App\Http\Controllers\UserController::class, 'update'])->name('updateprofile');
