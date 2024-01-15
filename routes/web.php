<?php

use Illuminate\Support\Facades\Route;

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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/tes', [App\Http\Controllers\HomeController::class, 'tes'])->name('tes');
Route::get('/profile/index', [App\Http\Controllers\UserController::class, 'index'])->name('profile');
Route::get('/profile/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('editprofile');
Route::post('/profile/update', [App\Http\Controllers\UserController::class, 'update'])->name('updateprofile');
