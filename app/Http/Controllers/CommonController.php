<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function index()
    {
        // return view('ess.index');
        return view('ecospotsearch.index');
    }
}
