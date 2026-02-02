@extends('layout.admin')

@section('title', 'Quản Lý Sản Phẩm')

@section('css')
    <style>
        /* CSS tùy chỉnh bổ sung cho Bootstrap */

        /* 1. Ảnh thumbnail trong bảng: Bo tròn, đổ bóng nhẹ, kích thước cố định */
        .product-image-thumb {
            width: 70px;
            height: 70px;
            object-fit: cover;
            /* Giúp ảnh không bị méo */
            border-radius: 5px;
            border: 1px solid #dee2e6;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        /* 2. Căn giữa nội dung trong ô bảng */
        .table td,
        .table th {
            vertical-align: middle !important;
        }

        /* 3. Giới hạn độ dài mô tả */
        .description-text {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* Chỉ hiện tối đa 2 dòng */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 14px;
            color: #6c757d;
        }

        /* 4. Hiệu ứng hover cho dòng */
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
    </style>
@endsection

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark font-weight-bold">Danh sách sản phẩm</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active">Sản phẩm</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">

        {{-- Thông báo Success --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{-- Card chính --}}
        <div class="card card-outline card-primary shadow-sm">
            <div class="card-header">
                <h3 class="card-title">
                    @if(Auth::check())
                        <i class="fas fa-user-tag mr-1"></i> Xin chào, <b>{{ Auth::user()->name }}</b>
                    @else
                        Quản lý kho hàng
                    @endif
                </h3>

                <div class="card-tools">
                    <a href="{{ route('product.add') }}" class="btn btn-success btn-sm elevation-1">
                        <i class="fas fa-plus-circle"></i> Thêm mới
                    </a>

                    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm ml-2 elevation-1"
                        onclick="return confirm('Bạn có chắc muốn đăng xuất?');">
                        <i class="fas fa-sign-out-alt"></i> Thoát
                    </a>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover projects">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 5%" class="text-center">#</th>
                                <th style="width: 10%">Ảnh</th>
                                <th style="width: 25%">Tên sản phẩm</th>
                                <th style="width: 30%">Mô tả</th>
                                <th style="width: 15%">Giá bán</th>
                                <th style="width: 15%" class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $key => $product)
                                <tr>
                                    {{-- ID --}}
                                    <td class="text-center text-muted">
                                        {{ $product->id }}
                                    </td>

                                    {{-- Ảnh (Đã sửa CSS cho gọn) --}}
                                    <td>
                                        <img src="{{ asset($product->image) }}" class="product-image-thumb"
                                            alt="{{ $product->name }}">
                                    </td>

                                    {{-- Tên & Ngày tạo --}}
                                    <td>
                                        <div class="font-weight-bold text-primary">{{ $product->name }}</div>
                                        <small class="text-muted">
                                            <i class="far fa-clock"></i>
                                            {{ $product->created_at ? $product->created_at->format('d/m/Y') : 'N/A' }}
                                        </small>
                                    </td>

                                    {{-- Mô tả --}}
                                    <td>
                                        <div class="description-text">
                                            {{ $product->description ?? 'Chưa có mô tả' }}
                                        </div>
                                    </td>

                                    {{-- Giá tiền --}}
                                    <td>
                                        <span class="badge badge-success px-2 py-1" style="font-size: 13px;">
                                            {{ number_format($product->price, 0, ',', '.') }} ₫
                                        </span>
                                    </td>

                                    {{-- Nút hành động --}}
                                    <td class="project-actions text-center">
                                        <a class="btn btn-info btn-sm mr-1" href="{{ route('product.edit', $product->id) }}"
                                            title="Sửa">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a class="btn btn-secondary btn-sm" href="{{ route('product.detail', $product->id) }}"
                                            title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('product.delete', $product->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không? Hành động này không thể hoàn tác!');">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm" title="Xóa">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <i class="fas fa-box-open fa-2x mb-2"></i><br>
                                        Không có sản phẩm nào trong kho.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Footer phân trang --}}
            <div class="card-footer bg-white d-flex justify-content-center">
                {{ $products->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection