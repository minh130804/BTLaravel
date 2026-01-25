<!DOCTYPE html>
<html>

<head>
    <title>Trang chủ</title>
</head>

<body>
    @if(session('user'))
        <p style="color: green">Xin chào, <b>{{ session('user') }}</b></p>
        <a href="{{ route('logout') }}">Đăng xuất</a>
    @else
        <p>Bạn chưa đăng nhập</p>
        <a href="{{ route('login') }}">Đăng nhập ngay</a>
    @endif

    <hr>
    <a href="{{ route('product.index') }}">Đi đến trang sản phẩm</a>
</body>

</html>