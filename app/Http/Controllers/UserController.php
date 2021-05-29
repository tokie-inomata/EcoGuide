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
        $user = Auth::user();
        return view("ess.user_page", ['user' => $user]);
    }

    public function create(Request $request)
    {
        return view("ess.user_add");
    }

    public function add(UserRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->newPassword);
        $user->admin_flg = $request->admin_flg;
        $user->blacklist_flg = $request->blacklist_flg;
        $user->save();
        
        return redirect('/user/login');
    }

    public function login(Request $request)
    {
        return view("ess.login");
    }

    public function signin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::guard('web')->attempt(['email' => $email, 'password' => $password]))
        {
            return redirect("/mypage");
        } else {
            return redirect()->back();
        }
    }

    public function edit(Request $request)
    {
        return view("ess.user_edit");
    }

    public function getLogout()
    {
    }
}
