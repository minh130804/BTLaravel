<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Gọi Model User để tương tác DB
use Illuminate\Support\Facades\Auth; // Gọi thư viện Auth chuẩn
use Illuminate\Support\Facades\Hash; // Gọi thư viện mã hóa mật khẩu
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    
    public function SignIn()
    {
        return view('login.signin');
    }

    public function CheckSignIn(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email|unique:users,email', 
            'password' => 'required|min:6',
            'name' => 'required'
        ], [
            'email.unique' => 'Email này đã có người đăng ký!',
            'password.min' => 'Mật khẩu phải từ 6 ký tự trở lên'
        ]);

        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            
            'password' => Hash::make($request->password), 
        ]);

     
        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    
    public function login()
    {
        return view('login.index');
    }

    public function postLogin(Request $request)
    {
        
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        
        if (Auth::attempt($credentials)) {
            
            
            $request->session()->regenerate();

            
            return redirect()->route('age.form');
        }

        
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ]);
    }

    
    public function logout(Request $request)
    {
        Auth::logout(); 
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function inputAge() {
        return view('login.input-age');
    }

    public function storeAge(Request $request) {
        $age = $request->input('age');
        if (!is_numeric($age) || $age < 18) {
            return redirect()->back()->with('error', 'Bạn chưa đủ 18 tuổi hoặc nhập sai định dạng!');
        }
        Session::put('age', $age);
        return redirect()->route('product.index');
    }
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // 2. Hàm nhận dữ liệu trả về từ Google/Facebook
    public function handleProviderCallback($provider)
    {
        try {
           
            $socialUser = Socialite::driver($provider)->user();

            
            $user = User::where('email', $socialUser->getEmail())
                        ->orWhere($provider . '_id', $socialUser->getId())
                        ->first();

            if ($user) {
                
                $user->update([
                    $provider . '_id' => $socialUser->getId(),
                    
                ]);
                
                Auth::login($user);
                
                return redirect()->route('product.index');
            } else {
                // Nếu chưa có -> Tạo tài khoản mới
                $newUser = User::create([
                    'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                    'email' => $socialUser->getEmail(),
                    $provider . '_id' => $socialUser->getId(),
                    'password' => null, 
                ]);

                Auth::login($newUser);

                return redirect()->route('product.index');
            }

       } catch (\Exception $e) {
    dd($e->getMessage()); 
}
    }
    
    
}