<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Http\Request;

class AutoCompleteController extends Controller
{
    public function __construct(SearchService $service)
    {
        $this->service = $service;
    }

    public function autocomplete(Request $request)
    {
        if(empty($_SERVER['HTTP_REFERER'])) {
            return redirect('/');
        }
        $selectAreaNum = $request->input('area');
        $cityInArea = $this->service->getCityListApi($selectAreaNum);
        //配列の中から市区町村の名前を配列に格納
        foreach($cityInArea as $city) {
            $cityList[] = $city['cityName'];
        }
        //jquery.jsのajaxにレスポンス
        header("Content-type: application/json; charset=UTF-8");
        return response()->json($cityList);
    }
}
