<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return view('ess.index');
    }

    public function search(Request $request)
    {
        return view('ess.search');
    }

    public function user_add(Request $request)
    {
        return view("ess.user_add");
    }
    
    public function details_search(Request $request)
    {
        return view("ess.details_search");
    }

    public function login(Request $request)
    {
        return view("ess.login");
    }
}
