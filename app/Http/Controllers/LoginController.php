<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // ====================================================
    // 1. PHẦN ĐĂNG NHẬP (LOGIN)
    // ====================================================

    /**
     * Hiển thị form đăng nhập
     */
    public function index()
    {
        // Nếu đã đăng nhập rồi thì chuyển thẳng vào trang home (hoặc trang check tuổi)
        if (Session::has('user')) {
            return redirect()->route('home');
        }
        return view('login');
    }

    /**
     * Xử lý dữ liệu đăng nhập gửi lên
     */
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Lấy thông tin tài khoản vừa Đăng ký từ Session (giả lập Database)
        $regUser = Session::get('reg_username');
        $regPass = Session::get('reg_password');

        // LOGIC KIỂM TRA:
        // 1. Là admin mặc định (admin / 123456)
        // 2. HOẶC là tài khoản vừa đăng ký
        if (($username == 'admin' && $password == '123456') || 
            ($username == $regUser && $password == $regPass && $regUser != null)) {
            
            // Đăng nhập thành công -> Lưu session user
            Session::put('user', $username);

            // QUAN TRỌNG: Chuyển hướng sang trang KIỂM TRA TUỔI thay vì về Home ngay
            return redirect()->route('age.form'); 
        } else {
            // Đăng nhập thất bại -> Quay lại và báo lỗi
            return redirect()->back()->with('error', 'Sai tên đăng nhập hoặc mật khẩu!');
        }
    }

    /**
     * Xử lý đăng xuất
     */
    public function logout()
    {
        Session::forget('user'); // Xóa session đăng nhập
        return redirect()->route('login');
    }


    // ====================================================
    // 2. PHẦN ĐĂNG KÝ (REGISTER)
    // ====================================================

    /**
     * Hiển thị form đăng ký
     */
    public function register()
    {
        return view('register');
    }

    /**
     * Xử lý lưu thông tin đăng ký
     */
    public function postRegister(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $confirmPassword = $request->input('confirm_password');

        // Kiểm tra mật khẩu nhập lại có khớp không
        if ($password != $confirmPassword) {
            return redirect()->back()->with('error', 'Mật khẩu xác nhận không khớp!');
        }

        // Lưu thông tin vào Session (để giả lập DB cho chức năng Login dùng)
        Session::put('reg_username', $username);
        Session::put('reg_password', $password);

        // Chuyển hướng về trang Login và thông báo thành công
        return redirect()->route('login')->with('success', 'Đăng ký thành công! Hãy đăng nhập ngay.');
    }


    // ====================================================
    // 3. PHẦN KIỂM TRA TUỔI (AGE CHECK)
    // ====================================================

    /**
     * Hiển thị form nhập tuổi
     */
    public function ageForm()
    {
        // Bảo mật: Phải đăng nhập mới được vào trang này
        if (!Session::has('user')) {
            return redirect()->route('login');
        }
        return view('check_age'); // Trả về view nhập tuổi
    }

    /**
     * Xử lý logic kiểm tra tuổi
     */
    public function processAge(Request $request)
    {
        $age = $request->input('age');

        // Kiểm tra logic tuổi
        if ($age >= 18) {
            // Đủ tuổi -> Cho phép vào trang chủ
            return redirect()->route('home');
        } else {
            // Không đủ tuổi -> Đăng xuất ngay lập tức
            Session::forget('user');
            
            // Đá về trang login kèm thông báo lỗi
            return redirect()->route('login')->with('error', 'Xin lỗi, bạn chưa đủ 18 tuổi để truy cập!');
        }
    }
}