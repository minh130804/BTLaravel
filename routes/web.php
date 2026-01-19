<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('home');
})->name('home');


Route::prefix('product')->group(function () {

    
    Route::get('/', function () {
        return view('product.index');
    })->name('product.index'); 

    
    Route::get('/add', function () {
        return view('product.add');
    })->name('product.add');

    
    Route::get('/{id?}', function ($id = '123') {
        return "Chi tiết sản phẩm - ID: " . $id;
    });
});


Route::get('/sinhvien/{name?}/{mssv?}', function ($name = 'Le Quang Minh', $mssv = '0035367') {
    return "Thông tin sinh viên: <br> Họ tên: $name <br> MSSV: $mssv";
});


Route::get('/banco/{n}', function ($n) {
    return view('banco', ['n' => $n]);
});


Route::fallback(function () {
    return view('error.404');
});