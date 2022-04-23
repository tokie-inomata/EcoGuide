<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view("ecospotsearch.user.index", ['user' => $user]);
    }

    public function edit()
    {
        $user = Auth::user();
        return view("ecospotsearch.user.edit", ['user' => $user]);
    }

    public function update(UserRequest $request, User $user)
    {
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
            return redirect(route('user.index'))->with('flash_message', 'ユーザー情報を変更しました。');
        } else {
            return redirect(route('user.index'))->with('flash_message', 'ユーザー情報の変更をしていません。');
        }
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect('/user/login')->with('flash_message','登録ユーザーを削除しました。');
    }

}
