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
        if(!empty($area)){
            foreach( config('pref') as $k => $val ) {
                foreach( $val as $k2 => $val2 ){
                    if( $area == $k2){
                        $search_area = $val2;
                    }
                }
            }
        }

        //選択された品目取得
        $item = $request->input('item');
        //選択された市区町村取得
        $municipality = $request->input('municipality');

        $spot = Spot::all();

        foreach($spot as $k => $val){
            //都道府県と市区町村と品目が選択された場合
            if(!empty($search_area) && !empty($item) && !empty($municipality)) {
                $spots = Spot::where('prefecture', $search_area)
                             //->whereIn('city', $search_pref)
                             ->where(function($quiry) use ($municipality) {
                                 foreach( $municipality as $k => $val ){
                                     $quiry->where('city', 'like', '%'.$val.'%');
                                 }
                             })
                             ->whereHas('recycling_items', function($quiry) use ($item) {
                                 $quiry->whereIn('recycling_item', $item);
                             })
                             ->paginate($paginate);
            //都道府県と品目が選択された場合
            } elseif(!empty($search_area) && !empty($item)) {
                $spots = Spot::where('prefecture', $search_area)
                             ->whereHas('recycling_items', function($quiry) use ($item) {
                                 $quiry->whereIn('recycling_item', $item);
                             })
                             ->paginate($paginate);
            //都道府県と市区町村が選択された場合
            } elseif(!empty($search_area) && !empty($municipality)) {
                $spots = Spot::where('prefecture', $search_area)
                             //->whereIn('city', $search_pref)
                             ->where(function($quiry) use ($municipality) {
                                foreach( $municipality as $k => $val ){
                                    $quiry->where('city', 'like', '%'.$val.'%');
                                }
                            })
                             ->paginate($paginate);
            //都道府県が選択され市区町村と品目が選択されてない場合
            } elseif(!empty($search_area) && empty($municipality) && empty($item)) {
                $spots = Spot::where('prefecture', $search_area)
                             ->paginate($paginate);
            } else {
                $spots = Spot::all();
            }
        }

        $count_spots = count($spots);

        //市区町村取得API
        $search_url = 'https://www.land.mlit.go.jp/webland/api/CitySearch?area='.$area;
        $city = json_decode(file_get_contents($search_url),true);

        $items = Recycling_item::all();

        //詳細検索の窓を開けるためのflg
        $flg = $request->flg;

        //ペジネーション時にgetパラメータを維持させるパラメータ
        if(!empty($municipality) && !empty($item)) {
            $search_param = [
                'area'        => $area,
                'municipality'=> $municipality,
                'item'        => $item,
                'paginate'    => $paginate,
            ];
        } elseif(!empty($municipality)) {
            $search_param = [ 
                'area'        => $area,
                'municipality'=> $municipality,
                'paginate'    => $paginate,
            ];
        } elseif(!empty($item)) {
            $search_param = [
                'area'        => $area,
                'item'        => $item,
                'paginate'    => $paginate,
            ];
        } else {
            $search_param = [
                'area'        => $area,
                'paginate'    => $paginate,
            ];
        }

        $param = [
            'spots'        => $spots,
            'flg'          => $flg,
            'request'      => $request,
            'city'         => $city,
            'items'        => $items,
            'area'         => $area,
            'municipality' => $municipality,
            'item'         => $item,
            'paginate'     => $paginate,
            'paginate'     => $paginate,
            'count_spots'  => $count_spots,
            'search_param' => $search_param,
        ];

        return view('ess.search', $param);
    }

}
