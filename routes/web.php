<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;

use Monolog\Level;

//JOBSHEET 2 : MEMBUAT ROUTE

//Controller Class Home
Route::get('/', [HomeController::class, 'home'])->name('home');

//Controller Class Category Daftar Produk
Route::prefix('category')->group(function () {
    Route::get('baby-kid', [ProductController::class, 'babyKid'])->name('category.baby-kid');
    Route::get('beauty-health', [ProductController::class, 'beautyHealth'])->name('category.beauty-health');
    Route::get('food-beverage', [ProductController::class, 'foodBeverage'])->name('category.food-beverage');
    Route::get('home-care', [ProductController::class, 'homeCare'])->name('category.home-care');
});

//Controller Class User/Profil
// Route::get('user/{id}/name/{name}', [UserController::class, 'profile'])->name('user.profile');

//Controller Class Saless/Penjualan
Route::get('sales', [SalesController::class, 'index'])->name('sales.index');

//================================================================================

//Jobsheet 3 : Implementasi DB FACADE
Route::get('/level', [LevelController::class, 'index']);

//Query Builder
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\WelcomeController;
use Monolog\Handler\RotatingFileHandler;

Route::get('/kategori', [KategoriController::class, 'index']);


//Eloquent ORM
Route::get('/user', [UserController::class, 'index']);

//Jobsheet 4 : ORM CRUD
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

Route::get('/', [WelcomeController::class, 'index']);