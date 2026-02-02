{{--
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            padding: 50px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            text-align: center;
        }

        img {
            max-width: 100%;
            border-radius: 8px;
            height: 300px;
            object-fit: cover;
        }

        h1 {
            color: #333;
            margin: 15px 0;
        }

        .price {
            color: #d9534f;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .desc {
            text-align: left;
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>

    <div class="card">
        <img src="{{ $product->image }}" alt="{{ $product->name }}">

        <h1>{{ $product->name }}</h1>

        <div class="price">
            {{ number_format($product->price, 0, ',', '.') }} VNĐ
        </div>

        <div class="desc">
            {{ $product->description ?? 'Chưa có mô tả cho sản phẩm này.' }}
        </div>
        <div style="margin-top: 20px;">


            <a href="{{ route('product.index') }}" class="btn" style="background-color: #6c757d;">
                ⬅ Quay lại
            </a>
        </div>


    </div>

</body>

</html> --}}
@extends('layout.admin')
@section('css')
    <style>
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            text-align: center;
        }




        h1 {
            color: #333;
            margin: 15px 0;
        }

        .price {
            color: #d9534f;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .desc {
            text-align: left;
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background: #0056b3;
        }
    </style>

@endsection
@section('content')
    <div class="card">
        <img src="{{ $product->image }}" alt="{{ $product->name }}">

        <h1>{{ $product->name }}</h1>

        <div class="price">
            {{ number_format($product->price, 0, ',', '.') }} VNĐ
        </div>

        <div class="desc">
            {{ $product->description ?? 'Chưa có mô tả cho sản phẩm này.' }}
        </div>
        <div style="margin-top: 20px;">


            <a href="{{ route('product.index') }}" class="btn" style="background-color: #6c757d;">
                ⬅ Quay lại
            </a>
        </div>


    </div>
@endsection