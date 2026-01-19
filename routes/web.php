<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// 1. Route "/" trả về view home
Route::get('/', function () {
    return view('home');
})->name('home');

// Gom nhóm "/product"
Route::prefix('product')->group(function () {

    // 2. "/product": Trả về view product.index
    Route::get('/', function () {
        return view('product.index');
    })->name('product.index'); // Đặt tên route để gọi (Yêu cầu về named route)

    // 3. "/product/add": Trả về view product.add
    Route::get('/add', function () {
        return view('product.add');
    })->name('product.add');

    // 4. "/product/{id}": id kiểu chuỗi, giá trị mặc định 123
    // Lưu ý: Route có tham số thường đặt cuối nhóm để tránh trùng lặp với /add
    Route::get('/{id?}', function ($id = '123') {
        return "Chi tiết sản phẩm - ID: " . $id;
    });
});

// 5. Route sinh viên với tham số tùy chọn và giá trị mặc định
Route::get('/sinhvien/{name?}/{mssv?}', function ($name = 'Luong Xuan Hieu', $mssv = '123456') {
    return "Thông tin sinh viên: <br> Họ tên: $name <br> MSSV: $mssv";
});

// 6. Route bàn cờ vua kích thước n*n
Route::get('/banco/{n}', function ($n) {
    return view('banco', ['n' => $n]);
});

// 7. Route Fallback: Xử lý khi không tìm thấy route (404)
Route::fallback(function () {
    return view('error.404');
});