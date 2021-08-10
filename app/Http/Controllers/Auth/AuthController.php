<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegsiterForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            Toastr::success('', 'Đăng nhập thành công!');
            return redirect()->route('home');
        }

        Toastr::error('Hãy kiểm tra lại thông tin đăng nhập của bạn', 'Không thể đăng nhập!');
        return redirect()->route('home');
    }


    public function register(RegsiterForm $request, User $user)
    {

        $input = $request->only('email', 'password', 'name');

        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = bcrypt($input['password']);
        try {
            $user->save();

            Toastr::success('bạn đã có thể đăng nhập.', 'Đăng ký thành công!');

            return redirect()->route('login');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function logout()
    {
        Auth::logout();
        Toastr::success('Đăng xuất thành công', 'Thành công!');
        return redirect()->route('home');
    }
}
