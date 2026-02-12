<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <--- Import thư viện Auth

class ProfileController extends Controller
{
    public function index()
    {
        // Lấy thông tin người đang đăng nhập
        $user = Auth::user(); 
        
        return view('admin.profile.index', compact('user'));
    }
}
