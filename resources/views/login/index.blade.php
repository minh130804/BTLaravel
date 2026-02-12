@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
<link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@section('auth_header', 'Đăng nhập để bắt đầu phiên làm việc')

@section('auth_body')

{{-- Hiển thị thông báo thành công --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

{{-- Hiển thị thông báo lỗi --}}
@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<form action="{{ route('login.post') }}" method="post">
    @csrf

    {{-- Email --}}
    <div class="input-group mb-3">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email') }}" placeholder="Email" autofocus>
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

    {{-- Password --}}
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

    {{-- Remember & Submit --}}
    <div class="row">
        <div class="col-7">
            <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Ghi nhớ tôi</label>
            </div>
        </div>
        <div class="col-5">
            <button type="submit" class="btn btn-block btn-flat btn-primary">
                <span class="fas fa-sign-in-alt"></span> Đăng nhập
            </button>
        </div>
    </div>
</form>

{{-- --- PHẦN MỚI THÊM: SOCIAL LOGIN --- --}}
<div class="social-auth-links text-center mb-3">
    <p>- HOẶC -</p>

    {{-- Nút Facebook --}}
    <a href="{{ route('auth.social', 'facebook') }}" class="btn btn-block btn-primary"
        style="background-color: #3b5998; border-color: #3b5998;">
        <i class="fab fa-facebook mr-2"></i> Đăng nhập bằng Facebook
    </a>

    {{-- Nút Google --}}
    <a href="{{ route('auth.social', 'google') }}" class="btn btn-block btn-danger"
        style="background-color: #dd4b39; border-color: #dd4b39;">
        <i class="fab fa-google mr-2"></i> Đăng nhập bằng Google
    </a>
</div>
{{-- ----------------------------------- --}}

@stop

@section('auth_footer')
<p class="my-0">
    <a href="{{ route('auth.signin') }}" class="text-center">Đăng ký tài khoản mới</a>
</p>
@stop