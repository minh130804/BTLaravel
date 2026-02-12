@extends('layout.admin')
@section('title', 'Quản Lý Danh Mục')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Danh sách danh mục</h3>
            <div class="card-tools">
                <a href="{{ route('category.create') }}" class="btn btn-sm btn-success">Thêm mới</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Danh mục cha</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td>{{ $cat->name }}</td>
                            <td>
                                @if($cat->parent)
                                    <span class="badge badge-info">{{ $cat->parent->name }}</span>
                                @else
                                    <span class="text-muted">Gốc</span>
                                @endif
                            </td>
                            <td>
                                @if($cat->is_active)
                                    <span class="badge badge-success">Hiển thị</span>
                                @else
                                    <span class="badge badge-secondary">Ẩn</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('category.edit', $cat->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                <a href="{{ route('category.delete', $cat->id) }}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Xóa danh mục này?')">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->links() }}
        </div>
    </div>
@endsection