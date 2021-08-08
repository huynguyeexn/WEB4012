<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Brian2694\Toastr\Facades\Toastr;

class GithubController extends Controller
{
    //
    public function login()
    {
        // if(Auth::check()){
        //    return redirect()->route('home');
        // }
        return Socialite::driver('github')->redirect();
    }
    public function callback()
    {
        $githubUser = Socialite::driver('github')->user();
        $user = null;

        DB::transaction(function () use($githubUser, &$user){
            $socialAccount = SocialAccount::firstOrNew(
                    [ 'social_id' => $githubUser->id, 'social_provider' => 'google', ],
                    [ 'social_name' => $githubUser->name, ]);
            if(!($user = $socialAccount->user)){

                // Đã có tài khoản trước đó
                if(!!($user = User::firstWhere('email', 'like', $githubUser->email))){
                    $user->avatar = $user->avatar ?: $githubUser->avatar;
                    $user->save();
                }else{
                    $user = User::create([
                        'email' => $githubUser->email,
                        'name' => $githubUser->name,
                        'avatar' => $githubUser->avatar,
                    ]);
                }
                $socialAccount->fill(['user_id' => $user->id])->save();
            }
        });

        if (Auth::loginUsingId($user['id'])) {
            Toastr::success('','Đăng nhập thành công!');
            return redirect()->route('home');
        } else {
            return "Error";
        }
    }
}
