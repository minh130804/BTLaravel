{{-- Kế thừa layout Auth của AdminLTE --}}
@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

{{-- Cấu hình tiêu đề trang --}}
@section('adminlte_css_pre')
<link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

{{-- Dòng chữ bên trên form --}}
@section('auth_header', 'Đăng nhập để bắt đầu phiên làm việc')

@section('auth_body')
{{-- Hiển thị thông báo thành công (nếu từ trang đăng ký chuyển qua) --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

{{-- Hiển thị lỗi đăng nhập chung --}}
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

    {{-- Input Email --}}
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

    {{-- Input Password --}}
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

    {{-- Nút Remember & Submit --}}
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
@stop

{{-- Footer: Link chuyển qua trang đăng ký --}}
@section('auth_footer')
<p class="my-0">
    <a href="{{ route('auth.signin') }}" class="text-center">Đăng ký tài khoản mới</a>
</p>
@stop