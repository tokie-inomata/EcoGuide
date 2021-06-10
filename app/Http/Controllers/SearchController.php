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
        $area = $request->input('area');

        $spots = Spot::all();

        $search_url = 'https://www.land.mlit.go.jp/webland/api/CitySearch?area='.$area;
        $city = json_decode(file_get_contents($search_url),true);

        $item = recycling_item::all();

        $flg = $request->flg;

        $param = [
            'spots' => $spots,
            'flg' => $flg,
            'request' => $request,
            'city' => $city,
            'item' => $item,
            'area' => $area,
        ];

        return view('ess.search', $param);
    }

}
