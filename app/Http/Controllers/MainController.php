<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('ess.index');
    }

    public function user_add(Request $request)
    {
        return view("ess.user_add");
    }

    public function login(Request $request)
    {
        return view("ess.login");
    }

    public function user_page()
    {
        return view("ess.user_page");
    }

    public function registration_list(Request $request)
    {
        return view("ess.registration_list");
    }

    public function userdata_change(Request $request)
    {
        return view("ess.userdata_change");
    }
}
