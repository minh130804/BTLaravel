<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng Ký Tài Khoản (SignIn)</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 50px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
        }

        input {
            padding: 5px;
            width: 250px;
        }

        button {
            padding: 10px 20px;
            background: blue;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h2>Form Đăng Ký (Theo yêu cầu SignIn)</h2>

    <form action="{{ route('auth.check') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" placeholder="Ví dụ: Hieulx" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <label>Re-Pass:</label>
            <input type="password" name="repass" placeholder="Nhập lại mật khẩu" required>
        </div>
        <div class="form-group">
            <label>MSSV:</label>
            <input type="text" name="mssv" placeholder="Nhập đúng MSSV của bạn" required>
        </div>
        <div class="form-group">
            <label>Lớp môn học:</label>
            <input type="text" name="lopmonhoc" placeholder="Ví dụ: 67PM1" required>
        </div>
        <div class="form-group">
            <label>Giới tính:</label>
            <input type="text" name="gioitinh" placeholder="nam/nu">
        </div>

        <button type="submit">Sign In (Đăng Ký)</button>
    </form>
</body>

</html>