<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
   
    
    public function login()
    {
        
        if (Session::has('user')) {
             if (!Session::has('age')) return redirect()->route('age.form');
             return redirect()->route('home');
        }
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        
        $regUser = Session::get('reg_username');
        $regPass = Session::get('reg_password'); 

       
        if (($username == 'admin' && $password == '123456') || 
            ($username == $regUser && $password == $regPass)) { 
            
            Session::put('user', $username);
            
            
            return redirect()->route('age.form'); 
        }

        return redirect()->back()->with('error', 'Tài khoản hoặc mật khẩu không đúng!');
    }

    public function logout()
    {
        Session::flush(); 
        return redirect()->route('login');
    }


   
    public function SignIn()
    {
        return view('SignIn');
    }

    public function CheckSignIn(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $repass   = $request->input('repass');
        
       
        if ($password !== $repass) {
            return redirect()->back()->with('error', 'Mật khẩu nhập lại không khớp!');
        }

        
        Session::put('reg_username', $username);
        Session::put('reg_password', $password);

        
        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }


    

    public function inputAge()
    {
        if (!Session::has('user')) return redirect()->route('login');
        return view('InputAge');
    }

    public function storeAge(Request $request)
    {
        $age = $request->input('age');
        
        
        if (!is_numeric($age)) {
             return redirect()->back()->with('error', 'Vui lòng nhập số tuổi hợp lệ!');
        }

        
        if ($age < 18) {
           
            return redirect()->back()->with('error', 'Bạn chưa đủ 18 tuổi. Vui lòng nhập lại!');
        }

        
        Session::put('age', $age);
        return redirect()->route('home');
    }
}