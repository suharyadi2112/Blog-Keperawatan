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

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');


Route::get('/', [App\Http\Controllers\FrontController::class, 'indexfrontend'])->name('welcome');
Route::get('/dokumentasi', [App\Http\Controllers\FrontController::class, 'indexDokumentasi'])->name('frontend.dokumentasi');
Route::get('/dokumen', [App\Http\Controllers\FrontController::class, 'indexDokumen'])->name('frontend.dokumen');
Route::get('/dokumen/detail/{id}', [App\Http\Controllers\FrontController::class, 'dokumenDetail'])->name('frontend.dokumenDetail');



Auth::routes(
    [
        'register' => true,
        'reset' => false,
        'verify' => false,
    ]
);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard/dokumentasi', [App\Http\Controllers\DokumentasiController::class, 'index'])->name('dokumentasi');
Route::post('/dashboard/dokumentasi', [App\Http\Controllers\DokumentasiController::class, 'store'])->name('dokumentasi.store');
Route::get('/dashboard/dokumentasi/{id}', [App\Http\Controllers\DokumentasiController::class, 'show'])->name('dokumentasi.show');
Route::delete('/dashboard/dokumentasi/{id}', [App\Http\Controllers\DokumentasiController::class, 'destroy'])->name('dokumentasi.destroy');


// Document Route
Route::resource('/dashboard/dokumen', DocumentController::class);


Route::get('/dashboard/informasi', [App\Http\Controllers\InformasiController::class, 'index'])->name('indexinformasi');
Route::post('/dashboard/addInformasi', [App\Http\Controllers\InformasiController::class, 'addInformasi'])->name('addInformasi');
Route::delete('/dashboard/delInformasi/{id}', [App\Http\Controllers\InformasiController::class, 'deleteInformasi'])->name('deleteInformasi');
Route::get('/dashboard/informasi/{id}', [App\Http\Controllers\InformasiController::class, 'informasiByID'])->name('informasiByID');
Route::get('/dashboard/informasi/update/{id}', [App\Http\Controllers\InformasiController::class, 'informasiShowUpdate'])->name('informasiShowUpdate');
Route::post('/dashboard/informasi/update/proses/{id}', [App\Http\Controllers\InformasiController::class, 'upDateInformasi'])->name('upDateInformasi');




Route::get('/dashboard/profile', [App\Http\Controllers\UserController::class, 'index'])->name('profile');
Route::get('/dashboard/profile/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('editprofile');
Route::post('/dashboard/profile/update', [App\Http\Controllers\UserController::class, 'update'])->name('updateprofile');
