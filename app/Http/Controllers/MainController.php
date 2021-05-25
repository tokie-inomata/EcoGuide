<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('ess.index');
    }

    public function user_page()
    {
        return view("ess.user_page");
    }

    public function pass_forget(Request $request)
    {
        return view('ess.pass_forget');
    }

    public function pass_reset(Request $request)
    {
        return view('ess.pass_reset');
    }

    public function pass_edit(Request $request)
    {
        return view('ess.pass_edit');
    }
}
