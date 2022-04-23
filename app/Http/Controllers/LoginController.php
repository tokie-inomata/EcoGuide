<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class LoginController extends Controller
{
    public function login()
    {
        return view("ecospotsearch.login");
    }

    public function create()
    {
        return view("ecospotsearch.signup");
    }

    public function store(Request $request)
    {
        $user                = new User($request->except('password'));
        $user->password      = Hash::make($request->password);
        $user->admin_flg     = 0;
        $user->blacklist_flg = 0;
        $user->save();
        Auth::guard()->login($user);

        return redirect(route('user.index'))->with('flash_message', 'ユーザーを作成しました。');
    }

    public function signin(Request $request)
    {
        $email    = $request->email;
        $password = $request->password;

        //ログイン処理
        if(Auth::attempt(['email' => $email, 'password' => $password, 'blacklist_flg' => 1])) {
            Auth::logout();
            return redirect(route('user.index'))->with('flash_message', 'このユーザーではログインできません。');
        } elseif(Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect(route('user.index'));
        } else {
            return redirect('/user/login')->with('flash_message', 'ログインに失敗しました。');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function pass_forget(Request $request)
    {
        return view('ess.pass_forget');
    }

    public function pass_reset(Request $request)
    {
        if(empty($_SERVER['HTTP_REFERER'])) {
            return redirect('/');
        } else {
            return view('ess.pass_reset');
        }
    }

    public function pass_edit(Request $request)
    {
        return view('ess.pass_edit');
    }
}
