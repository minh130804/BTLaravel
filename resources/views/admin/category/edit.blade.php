@extends('layout.admin')
@section('title', 'Sửa Danh Mục')
@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Cập nhật</h3>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('category.update', $category->id) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Tên danh mục</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                </div>

                <div class="form-group">
                    <label>Danh mục cha</label>
                    <select name="parent_id" class="form-control">
                        <option value="">-- Là danh mục gốc --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea name="description" class="form-control">{{ $category->description }}</textarea>
                </div>

                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" id="active" {{ $category->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">Kích hoạt hiển thị</label>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-warning">Cập nhật</button>
            </div>
        </form>
    </div>
@endsection