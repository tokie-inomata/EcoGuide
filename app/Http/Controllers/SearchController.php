<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spot;
use App\User;
use App\Recycling_item;
use App\Recycling_item_Spot;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $spots = Spot::all();

        $city = [
            '0' => 'テスト1',
            '1' => 'テスト2',
            '2' => 'テスト3',
            '3' => 'テスト4',
            '4' => 'テスト5',
            '5' => 'テスト6',
        ];

        $item = [
            '0' => '段ボール',
            '1' => '紙・雑誌',
            '2' => '衣類',
            '3' => '小型金属',
            '4' => '小型家電',
            '5' => 'その他',
        ];

        $flg = $request->flg;

        $area = $request->area;

        $city_count = count($city) / 2;
        $item_count = count($item) / 2;

        $param = [
            'spots' => $spots,
            'flg' => $flg,
            'request' => $request,
            'city' => $city,
            'item' => $item,
            'area' => $area,
            'city_count' => $city_count,
            'item_count' => $item_count,
        ];

        return view('ess.search', $param);
    }

}
