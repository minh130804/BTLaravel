<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        /* --- CẤU HÌNH CHUNG --- */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            /* Màu nền xám nhẹ hiện đại */
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* --- HEADER --- */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        h1 {
            color: #2c3e50;
            font-size: 24px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-add {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(118, 75, 162, 0.4);
        }

        /* --- GRID SẢN PHẨM (QUAN TRỌNG: 4 CỘT) --- */
        .product-grid {
            display: grid;
            /* Chia thành 4 cột bằng nhau */
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            /* Khoảng cách giữa các ô */
        }

        /* --- THẺ SẢN PHẨM (CARD) --- */
        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-10px);
            /* Hiệu ứng bay lên khi di chuột */
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        /* Ảnh sản phẩm */
        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            /* Đảm bảo ảnh không bị méo */
            background-color: #eee;
        }

        /* Nội dung thẻ */
        .card-content {
            padding: 20px;
            flex-grow: 1;
            /* Đẩy nút xuống đáy nếu nội dung ngắn */
            text-align: center;
        }

        .product-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
            /* Giới hạn 2 dòng tên */
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-desc {
            font-size: 13px;
            color: #777;
            margin-bottom: 15px;
            /* Giới hạn 3 dòng mô tả */
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-price {
            font-size: 18px;
            color: #e74c3c;
            /* Màu đỏ nổi bật cho giá */
            font-weight: bold;
            margin-bottom: 20px;
            display: block;
        }

        .btn-detail {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #f8f9fa;
            color: #333;
            text-decoration: none;
            font-weight: 600;
            border-top: 1px solid #eee;
            text-align: center;
            transition: background 0.3s;
        }

        .btn-detail:hover {
            background-color: #333;
            color: white;
        }

        /* --- RESPONSIVE (Tương thích di động) --- */
        /* Màn hình máy tính bảng: 3 cột */
        @media (max-width: 1024px) {
            .product-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Màn hình nhỏ hơn: 2 cột */
        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Điện thoại: 1 cột */
        @media (max-width: 480px) {
            .product-grid {
                grid-template-columns: 1fr;
            }

            .page-header {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="page-header">
            <h1>{{ $title ?? 'Cửa Hàng Công Nghệ' }}</h1>
            <a href="{{ route('product.add') }}" class="btn-add">
                + Thêm Sản Phẩm Mới
            </a>
        </div>

        <div class="product-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    <img src="{{ $product['image'] ?? 'https://loremflickr.com/320/240/gadget?random=' . $product['id'] }}"
                        alt="{{ $product['name'] }}" class="product-image">

                    <div class="card-content">
                        <div class="product-name">{{ $product['name'] }}</div>

                        <p class="product-desc">
                            {{ $product['description'] ?? 'Sản phẩm chất lượng cao, chính hãng, bảo hành 12 tháng.' }}
                        </p>

                        <span class="product-price">
                            {{ number_format($product['price'], 0, ',', '.') }} đ
                        </span>
                    </div>

                    <a href="{{ route('product.detail', $product['id']) }}" class="btn-detail">
                        Xem Chi Tiết
                    </a>
                </div>
            @endforeach
        </div>

    </div>

</body>

</html>