<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Brian2694\Toastr\Facades\Toastr;

class GoogleController extends Controller
{
    //
    public function login()
    {
        if(Auth::check()){
           return redirect()->route('home');
        }
        return Socialite::driver('google')->redirect();
    }
    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = null;

        DB::transaction(function () use($googleUser, &$user){
            $socialAccount = SocialAccount::firstOrNew(
                    [ 'social_id' => $googleUser->id, 'social_provider' => 'google', ],
                    [ 'social_name' => $googleUser->name, ]);
            if(!($user = $socialAccount->user)){

                // Đã có tài khoản trước đó
                if(!!($user = User::firstWhere('email', 'like', $googleUser->email))){
                    $user->avatar = $user->avatar ?: $googleUser->avatar;
                    $user->save();
                }else{
                    $user = User::create([
                        'email' => $googleUser->email,
                        'name' => $googleUser->name,
                        'avatar' => $googleUser->avatar,
                    ]);
                }
                $socialAccount->fill(['user_id' => $user->id])->save();
            }
        });

        if (Auth::loginUsingId($user->id)) {
            Toastr::success('','Đăng nhập thành công!');
            return redirect()->route('home');
        } else {
            return "Error";
        }
    }
}
