<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác minh độ tuổi</title>
    <style>
        /* Cấu hình giao diện chung */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fce4ec;
            /* Màu nền hồng nhạt hoặc vàng nhạt tùy thích */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Hộp nội dung chính */
        .age-box {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            color: #666;
            font-size: 14px;
            margin-bottom: 25px;
        }

        /* Phần hiển thị lỗi */
        .alert-error {
            background-color: #ffebee;
            color: #c62828;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ef9a9a;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 600;
        }

        /* Input và Button */
        input[type="number"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            /* Để padding không làm vỡ layout */
            font-size: 16px;
            text-align: center;
        }

        input[type="number"]:focus {
            outline: none;
            border-color: #e91e63;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #e91e63;
            /* Màu hồng đậm */
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #c2185b;
        }

        .icon {
            font-size: 40px;
            margin-bottom: 10px;
            display: block;
        }
    </style>
</head>

<body>

    <div class="age-box">
        <span class="icon">🔞</span>
        <h2>Xác Minh Độ Tuổi</h2>


        @if(session('error'))
            <div class="alert-error">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('age.store') }}" method="POST">
            @csrf

            <input type="number" name="age" placeholder="Nhập tuổi của bạn (VD: 20)" required min="1" autofocus>

            <button type="submit">Xác Nhận Truy Cập</button>
        </form>
    </div>

</body>

</html>