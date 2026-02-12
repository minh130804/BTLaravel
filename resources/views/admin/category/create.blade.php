@extends('layout.admin')
@section('title', 'Thêm Danh Mục')
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Thêm mới</h3>
        </div>
        <form action="{{ route('category.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Tên danh mục</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Danh mục cha (Nếu có)</label>
                    <select name="parent_id" class="form-control">
                        <option value="">-- Là danh mục gốc --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="active" checked>
                    <label class="form-check-label" for="active">Kích hoạt hiển thị</label>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </div>
@endsection