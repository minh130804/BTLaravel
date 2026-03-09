<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 
use App\Models\Category;
// Nhớ import Model Product của bạn vào

class HomeController extends Controller
{
    public function index()
    {
        // Lấy các sản phẩm mới nhất, mỗi trang hiển thị 8 sản phẩm
        $products = Product::orderBy('id', 'desc')->paginate(8);
        $categories = Category::where('is_active', 1)
                              ->where('is_delete', 0)
                              ->whereNull('parent_id')
                              ->with(['children' => function($query) {
                                  // Chỉ lấy các danh mục con cũng đang hoạt động
                                  $query->where('is_active', 1)->where('is_delete', 0);
                              }])
                              ->get();
        
        // Trả về file view frontend/home.blade.php cùng với biến $product
        return view('frontend.home', compact('products','categories'));
    }
}
