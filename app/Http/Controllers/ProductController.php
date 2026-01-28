<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $title = "Danh Sách 20 Sản Phẩm Mới Nhất";

        // Tạo dữ liệu giả: 20 sản phẩm
        $products = [];
        for ($i = 1; $i <= 20; $i++) {
            $products[] = [
                'id' => $i,
                'name' => 'Sản phẩm Công Nghệ Số ' . $i,
                'price' => rand(2000000, 30000000), // Giá ngẫu nhiên
                'image' => 'https://picsum.photos/300/300?random=' . $i, // Ảnh ngẫu nhiên
                'description' => 'Mô tả ngắn cho sản phẩm số ' . $i . '. Hàng chính hãng, bảo hành 12 tháng.'
            ];
        }

        return view('product.index', compact('title', 'products'));
    }

    public function getDetail($id)
    {
        return "Xem chi tiết sản phẩm có ID: " . $id ;
         
        
    }
}