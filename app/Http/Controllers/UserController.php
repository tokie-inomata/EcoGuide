<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request)
    {
        return view("ess.user_add");
    }

    public function login(Request $request)
    {
        return view("ess.login");
    }

    public function edit(Request $request)
    {
        return view("ess.user_edit");
    }
}
