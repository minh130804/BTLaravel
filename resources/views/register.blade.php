<!DOCTYPE html>
<html>

<head>
    <title>Đăng ký tài khoản</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f2f5;
        }

        .login-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 98%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>Đăng Ký</h2>

        {{-- Hiển thị lỗi nếu có --}}
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('register.post') }}" method="POST">
            @csrf
            <input type="text" name="username" placeholder="Tên đăng nhập mới" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu" required>

            <button type="submit">Đăng Ký</button>
        </form>
        <br>
        <a href="{{ route('login') }}">Đã có tài khoản? Đăng nhập</a>
    </div>
</body>

</html>