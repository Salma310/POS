<?php

use App\Http\Controllers\BarangController;
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
use App\Http\Controllers\SupplierController;
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

//Jobsheet 5
Route::get('/', [WelcomeController::class, 'index']);

Route::group(['prefix' => 'user'], function(){
    Route::get('/', [UserController::class, 'index']);          //menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);      //menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']);   //Menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);         //Menyimpan data user baru
    Route::get('/create_ajax', [UserController::class, 'create_ajax']); //Menampilkan halaman form tambah user ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']);      //Menyimpan data user baru ajax   
    Route::get('/{id}', [UserController::class, 'show']);       //menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);  //menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);     //menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); //Menampilkan halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);  //Menyimpan perubahan data user
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);  //tampilan form confirm ddelete user Ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); //untuk hapus data user ajax
    Route::delete('/{id}', [UserController::class, 'destroy']); //mengahapus data user
});

Route::group(['prefix' => 'level'], function(){
    Route::get('/', [LevelController::class, 'index']);          //menampilkan halaman awal user
    Route::post('/list', [LevelController::class, 'list']);      //menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [LevelController::class, 'create']);   //Menampilkan halaman form tambah user
    Route::post('/', [LevelController::class, 'store']);         //Menyimpan data user baru
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']); //Menampilkan halaman form tambah user ajax
    Route::post('/ajax', [LevelController::class, 'store_ajax']);      //Menyimpan data user baru ajax   
    Route::get('/{id}', [LevelController::class, 'show']);       //menampilkan detail user
    Route::get('/{id}/edit', [LevelController::class, 'edit']);  //menampilkan halaman form edit user
    Route::put('/{id}', [LevelController::class, 'update']);     //menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']); //Menampilkan halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);  //Menyimpan perubahan data user
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);  //tampilan form confirm ddelete user Ajax
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); //untuk hapus data user ajax
    Route::delete('/{id}', [LevelController::class, 'destroy']); //mengahapus data user
});

Route::group(['prefix' => 'kategori'], function(){
    Route::get('/', [KategoriController::class, 'index']);          //menampilkan halaman awal user
    Route::post('/list', [KategoriController::class, 'list']);      //menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [KategoriController::class, 'create']);   //Menampilkan halaman form tambah user
    Route::post('/', [KategoriController::class, 'store']);         //Menyimpan data user baru
    Route::get('/{id}', [KategoriController::class, 'show']);       //menampilkan detail user
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);  //menampilkan halaman form edit user
    Route::put('/{id}', [KategoriController::class, 'update']);     //menyimpan perubahan data user
    Route::delete('/{id}', [KategoriController::class, 'destroy']); //mengahapus data user
});

Route::group(['prefix' => 'supplier'], function(){
    Route::get('/', [SupplierController::class, 'index']);          //menampilkan halaman awal user
    Route::post('/list', [SupplierController::class, 'list']);      //menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [SupplierController::class, 'create']);   //Menampilkan halaman form tambah user
    Route::post('/', [SupplierController::class, 'store']);         //Menyimpan data user baru
    Route::get('/{id}', [SupplierController::class, 'show']);       //menampilkan detail user
    Route::get('/{id}/edit', [SupplierController::class, 'edit']);  //menampilkan halaman form edit user
    Route::put('/{id}', [SupplierController::class, 'update']);     //menyimpan perubahan data user
    Route::delete('/{id}', [SupplierController::class, 'destroy']); //mengahapus data user
});

Route::group(['prefix' => 'barang'], function(){
    Route::get('/', [BarangController::class, 'index']);          //menampilkan halaman awal user
    Route::post('/list', [BarangController::class, 'list']);      //menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [BarangController::class, 'create']);   //Menampilkan halaman form tambah user
    Route::post('/', [BarangController::class, 'store']);         //Menyimpan data user baru
    Route::get('/{id}', [BarangController::class, 'show']);       //menampilkan detail user
    Route::get('/{id}/edit', [BarangController::class, 'edit']);  //menampilkan halaman form edit user
    Route::put('/{id}', [BarangController::class, 'update']);     //menyimpan perubahan data user
    Route::delete('/{id}', [BarangController::class, 'destroy']); //mengahapus data user
});