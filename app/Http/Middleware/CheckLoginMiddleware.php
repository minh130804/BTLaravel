<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session; // Nhớ thêm dòng này

class CheckLoginMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem trong Session có 'user' hay không
        // (Biến 'user' này là do bên LoginController tạo ra khi đăng nhập thành công)
        if (Session::has('user')) {
            // Nếu có -> Cho phép đi tiếp
            return $next($request);
        }

        // Nếu không có -> Chặn lại và đẩy về trang login
        return redirect()->route('login')->with('error', 'Bạn phải đăng nhập để truy cập trang này!');
    }
}