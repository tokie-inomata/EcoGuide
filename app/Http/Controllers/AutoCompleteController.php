<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AutoCompleteController extends Controller
{
    public function autocomplete(Request $request)
    {
        if(empty($_SERVER['HTTP_REFERER'])) {
            return redirect('/');
        } else {
            //選択された都道府県IDを取得
            $select_pref = $request->input('pref');
            //APIを使うためのAPIキーを設定
            $header = ["X-API-KEY: 6lqPOe7CIQANL6DJWJ1JpnKf0QbAhm3D0Y3kwb1t"];
            //API取得のURL
            $url = 'https://opendata.resas-portal.go.jp/api/v1/cities?prefCode='. $select_pref;
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
            foreach($city_lists as $city) {
                $city_list[] = $city['cityName'];
            }
            //jquery.jsのajaxにレスポンス
            header("Content-type: application/json; charset=UTF-8");
            return response()->json($city_list);
        }
    }
}
