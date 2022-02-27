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
        return view("ecospotsearch.user.add");
    }

    public function store(Request $request)
    {
        //新しいユーザーを追加
        $user                = new User;
        $user->name          = $request->name;
        $user->email         = $request->email;
        $user->password      = Hash::make($request->password);
        $user->admin_flg     = $request->admin_flg;
        $user->blacklist_flg = $request->blacklist_flg;
        $user->save();

        //ユーザー追加が成功した場合ログイン状態にする
        Auth::guard()->login($user);

        return redirect('/mypage')->with('flash_message', 'ユーザーを作成しました。');
    }

    public function signin(Request $request)
    {
        //フォームに入力されたメールアドレス情報取得
        $email    = $request->email;
        //フォームに入力されたパスワード情報取得
        $password = $request->password;

        //ログイン処理
        if(Auth::attempt(['email' => $email, 'password' => $password, 'blacklist_flg' => 1])) {
            Auth::logout();
            return redirect('/user/login')->with('flash_message', 'このユーザーではログインできません。');
        } elseif(Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect("/mypage");
        } else {
            return redirect('/user/login')->with('flash_message', 'ログインに失敗しました。');
        }
    }

    public function getLogout()
    {
        //ログインユーザーをログアウトさせる
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
