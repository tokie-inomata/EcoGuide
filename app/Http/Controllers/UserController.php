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
        $login_user = Auth::user();
        return view("ess.user_page", ['login_user' => $login_user]);
    }

    public function create(Request $request)
    {
        return view("ess.user_add");
    }

    public function add(UserRequest $request)
    {
        $user                = new User;
        $user->name          = $request->name;
        $user->email         = $request->email;
        $user->password      = Hash::make($request->password);
        $user->admin_flg     = $request->admin_flg;
        $user->blacklist_flg = $request->blacklist_flg;
        $user->save();
        
        Auth::guard()->login($user);

        return redirect('/mypage');
    }

    public function login(Request $request)
    {
        return view("ess.login");
    }

    public function signin(Request $request)
    {
        $email    = $request->email;
        $password = $request->password;
        
        if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            return redirect("/mypage");
        } else {
            return redirect('/user/login');
        }
    }

    public function edit(Request $request)
    {
        $login_user = Auth::user();
        return view("ess.user_edit",['login_user' => $login_user]);
    }

    public function update(Request $request)
    {
        if(!empty($_POST['edit'])){
            $user = User::find($request->id);
            $user->name          = $request->name;
            $user->email         = $request->email;
            $user->password      = Hash::make($request->password);
            $user->admin_flg     = $request->admin_flg;
            $user->blacklist_flg = $request->blacklist_flg;
            $user->save();

            return redirect('/mypage');

        } elseif (!empty($_POST['delete'])){
            User::find($request->id)->delete();

            return redirect('/');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }

}
