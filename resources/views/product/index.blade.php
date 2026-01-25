<!DOCTYPE html>
<html>

<head>
    <title>Danh sách sản phẩm</title>
</head>

<body>
    <h1>
        {{ $title }}
    </h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product['id'] }}</td>
                <td>{{ $product['name'] }}</td>
                <td>{{ $product['price'] }}</td>
                <td>
                    <a href="{{ route('product.detail', $product['id']) }}">
                        <button type="button">Details</button>
                    </a>

                </td>
            </tr>

        @endforeach
    </table>

    <a href="{{ route('product.add') }}">
        <button type="button">Thêm mới sản phẩm</button>
    </a>
</body>

</html>