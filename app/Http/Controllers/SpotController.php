<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpotController extends Controller
{
    
    public function spot_add_list(Request $request)
    {
        $spot = array(
  
        );
        return view("ess.spot_add_list", ['spot' => $spot]);
    }
}
