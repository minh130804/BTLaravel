<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController; 


use App\Http\Middleware\CheckLoginMiddleware;
use App\Http\Middleware\CheckAge;
use App\Http\Middleware\CheckTimeAccess;


Route::get('/', function () {
    return view('login.index');
})->name('login.index');


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');




Route::get('/signin', [AuthController::class, 'SignIn'])->name('auth.signin');
Route::post('/check-signin', [AuthController::class, 'CheckSignIn'])->name('auth.check');


Route::get('/input-age', [AuthController::class, 'inputAge'])->name('age.form');
Route::post('/store-age', [AuthController::class, 'storeAge'])->name('age.store');






Route::prefix('product')->middleware(CheckLoginMiddleware::class)->group(function () {
    
    Route::get('/', [ProductController::class, 'index'])->name('product.index');

    Route::get('/add',[ProductController::class,'create'])->name('product.add');

    Route::get('/detail/{id}', [ProductController::class, 'getDetail'])->name('product.detail');

    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/delete/{id}', [ProductController::class,'delete'])->name('product.delete');
    
    

    
});
Route::get('/admin',function(){
        return view('layout.admin');
    });


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