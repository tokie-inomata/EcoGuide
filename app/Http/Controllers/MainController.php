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
}
