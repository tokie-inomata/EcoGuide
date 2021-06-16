<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{
    public function mypage(Request $request)
    {
        //ログインユーザー情報取得
        $login_user = Auth::user();
        return view("ess.user_page", ['login_user' => $login_user]);
    }

    public function create(Request $request)
    {
        return view("ess.user_add");
    }

    public function add(UserRequest $request)
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

        return redirect('/mypage');
    }

    public function login(Request $request)
    {
        return view("ess.login");
    }

    public function signin(Request $request)
    {
        //フォームに入力されたメールアドレス情報取得
        $email    = $request->email;
        //フォームに入力されたパスワード情報取得
        $password = $request->password;
        
        //もしUserテーブルに同じメールアドレス、パスワードがある場合ログインする
        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect("/mypage");
        } else {
            return redirect('/user/login');
        }
    }

    public function edit(Request $request)
    {
        //ログインユーザー情報取得
        $login_user = Auth::user();
        return view("ess.user_edit",['login_user' => $login_user]);
    }

    public function update(Request $request)
    {
        //editが押された場合
        if(!empty($_POST['edit'])){
            //選択されたユーザーIDを検索し更新
            $user = User::find($request->id);
            $user->name          = $request->name;
            $user->email         = $request->email;
            if(!empty($request->password)){
                $user->password  = Hash::make($request->password);
            }
            $user->admin_flg     = $request->admin_flg;
            if(empty($request->admin_flg)){
                $user->admin_flg = 0;
            }
            $user->blacklist_flg = $request->blacklist_flg;
            if(empty($request->blacklist_flg)){
                $user->blacklist_flg = 0;
            }
            $user->save();

            return redirect('/mypage');

        //deleteが押された場合
        } elseif (!empty($_POST['delete'])){
            //選択されたユーザーIDを検索し削除
            User::find($request->id)->delete();

            return redirect('/');
        }
    }

    public function getLogout()
    {
        //ログインユーザーをログアウトさせる
        Auth::logout();
        return redirect('/');
    }

}
