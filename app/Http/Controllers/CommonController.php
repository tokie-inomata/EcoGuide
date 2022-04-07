<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function index()
    {
        $prefectures = config('pref')->groupBy('area');
        return view('ecospotsearch.index', ['prefectures' => $prefectures]);
    }
}
