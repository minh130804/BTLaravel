{{-- Kế thừa layout Auth của AdminLTE, set type là register --}}
@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

@section('auth_header', 'Đăng ký thành viên mới')

@section('auth_body')
<form action="{{ route('auth.check') }}" method="post">
    @csrf

    {{-- Họ và Tên --}}
    <div class="input-group mb-3">
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name') }}" placeholder="Họ và tên" autofocus>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-user"></span>
            </div>
        </div>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- Email --}}
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email') }}" placeholder="Email">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-envelope"></span>
            </div>
        </div>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- Mật khẩu --}}
    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
            placeholder="Mật khẩu">
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock"></span>
            </div>
        </div>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    {{-- Nút Đăng ký --}}
    <button type="submit" class="btn btn-block btn-flat btn-success">
        <span class="fas fa-user-plus"></span> Đăng ký ngay
    </button>
</form>
@stop

{{-- Footer: Link quay lại trang đăng nhập --}}
@section('auth_footer')
<p class="my-0">
    <a href="{{ route('login') }}" class="text-center">Tôi đã có tài khoản</a>
</p>
@stop