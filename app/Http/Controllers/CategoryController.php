<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // 1. Xem danh sách (Chỉ lấy is_delete = 0)
    public function index()
    {
        $categories = Category::where('is_delete', 0)->paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    // 2. Form thêm mới
    public function create()
    {
        // Lấy danh sách để chọn làm cha (trừ những cái đã xóa)
        $categories = Category::where('is_delete', 0)->get();
        return view('admin.category.create', compact('categories'));
    }

    // 3. Lưu dữ liệu
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_delete' => 0
        ]);

        return redirect()->route('category.index')->with('success', 'Thêm danh mục thành công');
    }

    // 4. Form sửa (Logic chống vòng lặp)
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        
        // Lấy danh sách cha: Loại bỏ chính nó ra khỏi danh sách select
        // (Logic nâng cao hơn: Loại bỏ cả con của nó, nhưng ở mức cơ bản ta chặn chính nó trước)
        $categories = Category::where('is_delete', 0)
                              ->where('id', '!=', $id) 
                              ->get();

        return view('admin.category.edit', compact('category', 'categories'));
    }

    // 5. Cập nhật
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = Category::findOrFail($id);

        // Kiểm tra logic: Không được chọn chính mình làm cha
        if ($request->parent_id == $id) {
            return back()->with('error', 'Không thể chọn chính danh mục này làm cha!');
        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('category.index')->with('success', 'Cập nhật thành công');
    }

    // 6. Xóa mềm (Soft Delete - Update is_delete = 1)
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->update(['is_delete' => 1]); // Không xóa thật, chỉ ẩn đi
        
        return redirect()->route('category.index')->with('success', 'Đã xóa danh mục');
    }
}
