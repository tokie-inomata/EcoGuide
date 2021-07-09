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
        //ペジネーション取得
        $paginate = $request->input('paginate');
        //選択された都道府県の名前を取得
        if(!empty($area)) {
            //都道府県の配列をforeach
            foreach(config('pref') as $k => $val) {
                //IDと名前で分ける
                foreach($val as $k2 => $val2) {
                    //選択されたIDと同じIDの場合
                    if($area == $k2) {
                        //選択された都道府県名を取得
                        $search_area = $val2;
                    }
                }
            }
        }

        //選択された品目ID取得
        $item = $request->input('item');
        //選択された品目データを取得
        if(!empty($item)) {
            //選択された品目IDと同じ品目データを取得
            $search_item = Recycling_item::whereIn('id',$item)->get();
            //取得した品目データをforeach
            foreach($search_item as $k => $val) {
                //選択された品目名を配列で取得
                $search_items[] = $val->recycling_item;
            }
        }
        //全品目情報取得
        $items = Recycling_item::all();

        //APIを使うためのAPIキーを設定
        $header = ["X-API-KEY: 6lqPOe7CIQANL6DJWJ1JpnKf0QbAhm3D0Y3kwb1t"];
        //市区町村API取得のURL
        $url = 'https://opendata.resas-portal.go.jp/api/v1/cities?prefCode='. $area;
        //API取得のHTTPリクエスト開始
        $curl = curl_init($url);
        //メソッドをGETに指定
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        //リクエスト時に設定したAPIキー使用
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        //レスポンスを文字列で取得
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //レスポンスを変数に格納
        $response = curl_exec($curl);
        //HTTPリクエスト終了
        curl_close($curl);

        //レスポンスをJson配列で取得
        $city_lists = json_decode($response,true)['result'];
        //配列の中から市区町村の名前を配列に格納
        foreach($city_lists as $city_list) {
            $city[] = [$city_list['cityCode'] => $city_list['cityName']];
        }
        $count_city = count($city);

        //選択された市区町村ID取得
        $municipality = $request->input('municipality');
        //選択された市区町村の名前を取得
        if(!empty($municipality)) {
            //API情報で取得した情報をforeach
            foreach ($city as $k => $val) {
                //市区町村データの配列をforeach
                foreach($val as $k2 => $val2) {
                    //選択された市区町村IDをforeach
                    foreach($municipality as $k3 => $val3) {
                        //APIにある市区町村データのIDと選択された市区町村IDが同じ場合
                        if($k2 == $val3) {
                            //選択された市区町村の名前を配列で取得
                            $search_city[] = $val2;
                        }
                    }
                }
            }
        }

        //詳細検索の窓を開けるためのflg
        $flg = $request->input('flg');
        //configにあるconstをforeach
        foreach(config('const') as $k => $val) {
            //flgの情報に限定
            if($k == 'flg') {
                //flgの中身をforeach
                foreach($val as $k2 ){
                    //$flgと同じ数字じゃないものを取得
                    if($flg != $k2) {
                        $details_flg = $k2;
                    }
                }
            }
        }

        //市区町村と品目が選択された場合
        if(!empty($item) && !empty($municipality)) {
            $spots = Spot::where('prefecture', $search_area)
                         ->Where(function($query) use ($search_city) {
                                foreach( $search_city as $k => $val ){
                                    $query->where('city', 'like', '%'.$val.'%');
                                }
                             })
                         ->WhereHas('recycling_items', function($query) use ($search_items) {
                                $query->whereIn('recycling_item', $search_items);
                             })
                         ->paginate($paginate);
        //品目が選択された場合
        } elseif(!empty($item)) {
            $spots = Spot::where('prefecture', $search_area)
                         ->whereHas('recycling_items', function($query) use ($search_items) {
                                $query->whereIn('recycling_item', $search_items);
                             })
                         ->paginate($paginate);
        //市区町村が選択された場合
        } elseif(!empty($municipality)) {
            $spots = Spot::where('prefecture', $search_area)
                         ->where(function($query) use ($search_city) {
                            foreach( $search_city as $k => $val ){
                                $query->where('city', 'like', '%'.$val.'%');
                            }
                         })
                         ->paginate($paginate);
        //URL直入力で接続された場合
        } elseif(empty($search_area)) {
            $spots = Spot::paginate($paginate);
        } else {
            $spots = Spot::where('prefecture', $search_area)
                         ->paginate($paginate);
        }

        $count_spots = count($spots);

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
            'details_flg'  => $details_flg,
            'count_city'   => $count_city,
        ];

        return view('ess.search', $param);
    }

    public function city_search(Request $request)
    {
        //選択された都道府県IDを取得
        $area = $request->input('area');
        //APIを使うためのAPIキーを設定
        $header = ["X-API-KEY: 6lqPOe7CIQANL6DJWJ1JpnKf0QbAhm3D0Y3kwb1t"];
        //市区町村API取得のURL
        $url = 'https://opendata.resas-portal.go.jp/api/v1/cities?prefCode='. $area;
        //API取得のHTTPリクエスト開始
        $curl = curl_init($url);
        //メソッドをGETに指定
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        //リクエスト時に設定したAPIキー使用
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        //レスポンスを文字列で取得
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //レスポンスを変数に格納
        $response = curl_exec($curl);
        //HTTPリクエスト終了
        curl_close($curl);

        //レスポンスをJson配列で取得
        $city_lists = json_decode($response,true)['result'];
        //配列の中から市区町村の名前を配列に格納

        //jquery.jsのajaxにレスポンス
        header("Content-type: application/json; charset=UTF-8");
        return response()->json($city_lists);
    }
}