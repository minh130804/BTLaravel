<!DOCTYPE html>
<html>

<head>
    <title>Xác minh độ tuổi</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #fff3cd;
        }

        .box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }

        input {
            padding: 10px;
            width: 80%;
            margin: 15px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px 20px;
            background-color: #ffc107;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #e0a800;
        }
    </style>
</head>

<body>
    <div class="box">
        <h2>🔞 Kiểm tra độ tuổi</h2>
        <p>Bạn phải trên 18 tuổi để truy cập trang web này.</p>

        <form action="{{ route('age.process') }}" method="POST">
            @csrf
            <label>Vui lòng nhập tuổi của bạn:</label><br>
            <input type="number" name="age" placeholder="Ví dụ: 20" required min="1">
            <br>
            <button type="submit">Xác nhận</button>
        </form>
    </div>
</body>

</html>