<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view("ess.user_page", ['user' => $user]);
    }

    public function show(Request $request)
    {
    }

    public function edit(Request $request)
    {
    }

    public function update($request)
    {
        //選択されたユーザーIDを検索し更新
        $user = User::find($request->id);
        $user->name          = $request->name;
        $user->email         = $request->email;
        if(!empty($request->password)){
            if(!password_verify($request->password, $user->password)) {
                $user->password  = Hash::make($request->password);
            }
        }
        if(!empty($request->admin_flg)) {
            $user->admin_flg = $request->admin_flg;
        } else {
            $user->admin_flg = 0;
        }
        if(!empty($request->blacklist_flg)) {
            $user->blacklist_flg = $request->blacklist_flg;
        } else {
            $user->blacklist_flg = 0;
        }

        if($user->isDirty()) {
            $user->save();
            return redirect('/mypage')->with('flash_message', 'ユーザー情報を変更しました。');
        } else {
            return redirect('/mypage')->with('flash_message', 'ユーザー情報の変更をしていません。');
        }
    }

    public function destroy($request)
    {
        //選択されたユーザーIDを検索し削除
        User::find($request->id)->delete();

        return redirect('/user/login')->with('flash_message','登録ユーザーを削除しました。');
    }

}
