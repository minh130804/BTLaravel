<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController; // <--- CHỈ DÙNG AUTHCONTROLLER

// Middleware
use App\Http\Middleware\CheckLoginMiddleware;
use App\Http\Middleware\CheckAge;
use App\Http\Middleware\CheckTimeAccess;

// --- TRANG CHỦ ---
Route::get('/', function () {
    return view('home');
})->name('home');

// --- AUTHENTICATION (Dùng AuthController thay LoginController) ---
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// --- BÀI TẬP GIÁO VIÊN ---
// 1. Đăng ký (SignIn)
Route::get('/signin', [AuthController::class, 'SignIn'])->name('auth.signin');
Route::post('/check-signin', [AuthController::class, 'CheckSignIn'])->name('auth.check');

// 2. Kiểm tra tuổi
Route::get('/input-age', [AuthController::class, 'inputAge'])->name('age.form');
Route::post('/store-age', [AuthController::class, 'storeAge'])->name('age.store');

// 3. Trang Admin (Cần middleware CheckAge)
Route::middleware([CheckAge::class])->group(function () {
    Route::get('/admin-page', [AuthController::class, 'adminPage'])->name('admin.page');
});


// --- SẢN PHẨM (Cần middleware CheckLoginMiddleware) ---
// Lưu ý: Middleware này kiểm tra Session 'user' mà AuthController đã tạo khi Login
Route::prefix('product')->middleware(CheckLoginMiddleware::class)->group(function () {
    
    Route::get('/', [ProductController::class, 'index'])->name('product.index');

    Route::get('/add', function () {
        return view('product.add');
    })->name('product.add');

    Route::get('/detail/{id}', [ProductController::class, 'getDetail'])->name('product.detail');

    Route::get('/{id?}', function ($id = '123') {
        return "Chi tiết sản phẩm - ID: " . $id;
    });
});


// --- KHÁC ---
Route::get('/sinhvien/{name?}/{mssv?}', function ($name = 'Minh', $mssv = '123') {
    return "SV: $name - $mssv";
});

Route::get('/banco/{n}', function ($n) { 
    return view('banco', ['n' => $n]);
});

Route::resource('test', TestController::class);

Route::fallback(function () {
    return view('error.404');
});