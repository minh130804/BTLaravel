<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    
    public function index()
    {
        return view('login');
    }

    
    public function login(Request $request)
    {
       
        $username = $request->input('username');
        $password = $request->input('password');

        
        
        if ($username == 'admin' && $password == '123456') {
            
           
            Session::put('user', $username);

           
            return redirect()->route('home');
        } else {
            
            return redirect()->back()->with('error', 'Sai tên đăng nhập hoặc mật khẩu!');
        }
    }

    
    public function logout()
    {
        Session::forget('user'); 
        return redirect()->route('login');
    }
}