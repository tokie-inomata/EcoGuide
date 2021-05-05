<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function details_search(Request $request)
    {
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
        $param = [
            'city' => $city,
            'item' => $item,
        ];
        return view("ess.details_search", $param);
    }

    public function search(Request $request)
    {
        $spot = [

            '0' => [
                'name' => 'test1',
                'address' => 'test1',
                'item' => 'test1',
            ],
            '1' => [
                'name' => 'test2',
                'address' => 'test2',
                'item' => 'test2',
            ],
            '2' => [
                'name' => 'test3',
                'address' => 'test3',
                'item' => 'test3',
            ]
        ];

        return view('ess.search', [ 'spot' => $spot]);
    }

}
