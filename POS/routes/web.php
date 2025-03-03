<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

// menampilkan halaman Home
Route::get('/home', [HomeController::class, 'index']);

// menampilkan daftar produk berdasarkan kategori (route prefix)
Route::prefix('category')->group(function () {
    Route::get('/{category}', [ProductController::class, 'category']);
});

// menampilkan profil user berdasarkan id dan name(route parameter)
Route::get('/user/{id}/name/{name}', [UserController::class, 'profile']);

use App\Http\Controllers\TransactionController;

Route::get('/transactions', [TransactionController::class, 'index']);



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
