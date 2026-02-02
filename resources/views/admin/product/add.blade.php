{{--
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm mới</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        .form-container {
            background: white;
            width: 100%;
            max-width: 600px;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #555;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;

            transition: 0.3s;
        }

        input:focus,
        textarea:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-submit:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .btn-back {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #888;
            font-size: 14px;
        }

        .btn-back:hover {
            color: #333;
        }

        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>Thêm Sản Phẩm Mới</h2>

        <form action="{{ route('product.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Tên sản phẩm:</label>
                <input type="text" name="name" placeholder="Nhập tên sản phẩm..." value="{{ old('name') }}">
                @error('name') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Giá bán (VNĐ):</label>
                <input type="number" name="price" placeholder="Nhập giá tiền..." value="{{ old('price') }}">
                @error('price') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Link Ảnh (URL):</label>
                <input type="url" name="image" placeholder="https://example.com/anh.jpg" value="{{ old('image') }}">
                @error('image') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Mô tả chi tiết:</label>
                <textarea name="description" placeholder="Mô tả sản phẩm...">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn-submit">Lưu Sản Phẩm</button>
            <a href="{{ route('product.index') }}" class="btn-back">Quay lại danh sách</a>
        </form>
    </div>

</body>

</html> --}}

@extends('layout.admin')

@section('content')
    <div class="form-container">
        <h2>Thêm Sản Phẩm Mới</h2>

        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Tên sản phẩm:</label>
                <input type="text" name="name" placeholder="Nhập tên sản phẩm..." value="{{ old('name') }}">
                @error('name') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Giá bán (VNĐ):</label>
                <input type="number" name="price" placeholder="Nhập giá tiền..." value="{{ old('price') }}">
                @error('price') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="image">Ảnh sản phẩm:</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="image">
                        <label class="custom-file-label" for="image">Chọn file ảnh</label>
                    </div>
                </div>
                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Mô tả chi tiết:</label>
                <textarea name="description" placeholder="Mô tả sản phẩm...">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn-submit">Lưu Sản Phẩm</button>
            <a href="{{ route('product.index') }}" class="btn-back">Quay lại danh sách</a>
        </form>
    </div>
@endsection