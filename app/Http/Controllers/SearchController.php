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
        //選択された都道府県のID取得
        $area = $request->input('area');
        //ペジネーション選択
        $paginate = $request->input('paginate');
        //選択された都道府県の名前を取得
        foreach( config('pref') as $k => $val ) {
            foreach( $val as $k2 => $val2 ){
                if( $area == $k2){
                    $search_area = $val2;
                }
            }
        }

        //選択された品目取得
        $search_item = $request->input('item');
        //選択された市区町村取得
        $search_pref = $request->input('municipality');

        $spot = Spot::all();

        foreach($spot as $k => $val){
            //都道府県と市区町村と品目が選択された場合
            if(!empty($search_area) && !empty($search_item) && !empty($search_pref)) {
                $spots = Spot::where('prefecture', $search_area)
                             ->whereIn('city', $search_pref)
                             ->whereHas('recycling_items', function($quiry) use ($search_item) {
                                 $quiry->whereIn('recycling_item', $search_item);
                             })
                             ->paginate($paginate);
            //都道府県と品目が選択された場合
            } elseif(!empty($search_area) && !empty($search_item)) {
                $spots = Spot::where('prefecture', $search_area)
                             ->whereHas('recycling_items', function($quiry) use ($search_item) {
                                 $quiry->whereIn('recycling_item', $search_item);
                             })
                             ->paginate($paginate);
            //都道府県と市区町村が選択された場合
            } elseif(!empty($search_area) && !empty($search_pref)) {
                $spots = Spot::where('prefecture', $search_area)
                             ->whereIn('city', $search_pref)
                             ->paginate($paginate);
            //都道府県が選択され市区町村と品目が選択されてない場合
            } elseif(!empty($search_area) && empty($search_pref) && empty($search_item)) {
                $spots = Spot::where('prefecture', $search_area)
                             ->paginate($paginate);
            }
        }

        //市区町村取得API
        $search_url = 'https://www.land.mlit.go.jp/webland/api/CitySearch?area='.$area;
        $city = json_decode(file_get_contents($search_url),true);

        $item = Recycling_item::all();

        //詳細検索の窓を開けるためのflg
        $flg = $request->flg;

        $param = [
            'spots' => $spots,
            'flg' => $flg,
            'request' => $request,
            'city' => $city,
            'item' => $item,
            'area' => $area,
            'search_area' => $search_area,
            'paginate' => $paginate,
            'search_item' => $search_item,
            'search_pref' => $search_pref,
            'paginate' => $paginate,
        ];

        return view('ess.search', $param);
    }

}
