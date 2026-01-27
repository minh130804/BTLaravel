<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// Import các Controller và Middleware
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\CheckLoginMiddleware;
use App\Http\Middleware\CheckTimeAccess;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::prefix('product')->middleware(CheckTimeAccess::class)->group(function () {
    
   
    Route::get('/', [ProductController::class, 'index'])->name('product.index');

    
    Route::get('/add', function () {
        return view('product.add');
    })->name('product.add');

    
    Route::get('/detail/{id}', [ProductController::class, 'getDetail'])->name('product.detail');

    
    Route::get('/{id?}', function ($id = '123') {
        return "Chi tiết sản phẩm (Quick View) - ID: " . $id;
    });
})->middleware(CheckTimeAccess::class);


Route::get('/sinhvien/{name?}/{mssv?}', function ($name = 'Le Quang Minh', $mssv = '0035367') {
    return "Thông tin sinh viên: <br> Họ tên: $name <br> MSSV: $mssv";
});

Route::get('/banco/{n}', function ($n) { 
    return view('banco', ['n' => $n]);
});
Route::resource('test',TestController::class);

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'postRegister'])->name('register.post');
Route::get('/check-age', [LoginController::class, 'ageForm'])->name('age.form');
Route::post('/check-age', [LoginController::class, 'processAge'])->name('age.process');


Route::fallback(function () {
    return view('error.404');
});