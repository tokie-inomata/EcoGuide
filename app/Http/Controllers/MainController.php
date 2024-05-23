<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;

class MainController extends Controller
{
    public function index()
    {
        return view('ess.index');
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
