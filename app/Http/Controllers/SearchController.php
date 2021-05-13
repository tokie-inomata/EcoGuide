<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $spot = array(
            array(
                'name' => 'test1',
                'address' => 'test2',
                'item' => 'test3',
            ),
            array(
                'name' => 'test4',
                'address' => 'test5',
                'item' => 'test6',
            ),
            array(
                'name' => 'test7',
                'address' => 'test8',
                'item' => 'test9',
            ),
        );

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

        $flg = $request -> flg;

        $area = $request -> area;

        $param = [
            'spot' => $spot,
            'flg' => $flg,
            'request' => $request,
            'city' => $city,
            'item' => $item,
            'area' => $area,
        ];

        return view('ess.search', $param);
    }

}
