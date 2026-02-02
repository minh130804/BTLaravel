<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $title = "Danh Sách Sản Phẩm Mới Nhất";

        $products=Product::latest()->paginate(8);

        return view('admin.product.index', compact('title', 'products'));
    }

    public function getDetail($id)
    {
       $product = Product::findOrFail($id);
       return view('admin.product.detail', compact('product'));
         
    }
    public function create(){
        return view('admin.product.add');
    }
    public function store(Request $request){
        $request->validate([
            'name'=>'required|min:5',
            'price'=>'required|numeric',
            'description'=>'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ],[
            'image.required' => 'Vui lòng chọn ảnh sản phẩm.',
            'image.image' => 'File tải lên phải là ảnh.',
            'image.max' => 'Kích thước ảnh không được vượt quá 2MB.',
        ]);
        $imagePath=null;
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $fileName= time().'.'.$file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $fileName);
            $imagePath = 'uploads/products/' .$fileName;
        }
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath, 
            'description' => $request->description
        ]);

       
        return redirect()->route('product.index')->with('success','Thêm sản phẩm thành công');
    }
    public function edit($id){
        $product = Product::findOrFail($id);
        $title = "Chỉnh sửa sản phẩm";
        return view('admin.product.edit', compact ('product'));
    }
    public function update(Request $request, $id)
    {
        
        $product = Product::findOrFail($id);

       
        $request->validate([
            'name' => 'required|min:5',
            'price' => 'required|numeric',
            
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'description' => 'nullable'
        ]);

        
        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ];

    
        if ($request->hasFile('image')) {
            
            $oldImagePath = public_path($product->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            
            
            $data['image'] = 'uploads/products/' . $filename;
        }
        

        
        $product->update($data);

        return redirect()->route('product.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }
    public function delete($id){
        $product = Product::findOrFail($id);
        if ($product->image) {
            $imagePath = public_path($product->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Xóa sản phẩm thành công!');
    }
} 

    
