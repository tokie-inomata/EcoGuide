<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Spot;
use App\Recycling_item;
use App\Recycling_item_spot;

class SpotController extends Controller
{
    
    public function index(Request $request)
    {
        $spot = array(
  
        );
        return view("ess.spot_add_list", ['spot' => $spot]);
    }

    public function create(Request $request)
    {
        $item = [
            '0' => '段ボール',
            '1' => '紙・雑誌',
            '2' => '衣類',
            '3' => '小型金属',
            '4' => '小型家電',
            '5' => 'その他',
        ];

        return view("ess/spot_add", ['item' => $item]);
    }

    public function edit(Request $request)
    {
        $item = [
            '0' => '段ボール',
            '1' => '紙・雑誌',
            '2' => '衣類',
            '3' => '小型金属',
            '4' => '小型家電',
            '5' => 'その他',
        ];

        return view("ess/spot_edit", ['item' => $item]);
    }
}
