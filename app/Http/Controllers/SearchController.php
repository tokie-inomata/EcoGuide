<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spot;
use App\Recycling_item;
use App\Services\SearchService;

class SearchController extends Controller
{
    public function __construct(SearchService $service)
    {
        $this->service = $service;
    }

    public function search(Request $request)
    {
        if(empty($_SERVER['HTTP_REFERER'])) {
            return redirect('/');
        }

        $selectAreaNum  = $request->input('area');
        $selectItemIds  = $request->input('item');
        $paginateNum    = $request->input('paginate');
        $selectCityNum  = $request->input('municipality');
        $allItems       = Recycling_item::all();
        $citys          = [];

        $selectAreaName = $this->service->selectArea($selectAreaNum);

        $cityInArea     = $this->service->getCityListApi($selectAreaNum);
        foreach($cityInArea as $city) {
            $citys[]    = [$city['cityCode'] => $city['cityName']];
        }

        if($selectCityNum) {
            $selectCityName = $this->service->selectCity($citys, $selectCityNum);
        }

        if($selectItemIds) {
            $selectItemName = $this->service->selectItem($selectItemIds);
        }

        $spots = Spot::where('prefecture', $selectAreaName)
                        ->paginate($paginateNum)->all();
        $searchParam = [
            'area' => $selectAreaNum,
            'paginate' => $paginateNum,
        ];

        $spotsCount     = count($spots);

        if($selectCityNum) {
            $spots = $this->service->cityOnlySearch($selectAreaName, $selectCityName, $paginateNum);
            $searchParam = $this->service->cityOnlyParam($selectAreaNum, $selectCityNum, $paginateNum);
        }
        if($selectItemIds) {
            $spots = $this->service->itemOnlySearch($selectAreaName, $selectItemName, $paginateNum);
            $searchParam = $this->service->itemOnlyParam($selectAreaNum, $selectItemIds, $paginateNum);
        }
        if($selectCityNum && $selectItemIds) {
            $spots = $this->service->allSearch($selectAreaName, $selectItemName, $selectCityName, $paginateNum);
            $searchParam = $this->service->allParam($selectAreaNum, $selectItemIds, $selectCityNum, $paginateNum);
        }

        $param = [
            'area' => $selectAreaNum,
            'paginate' => $paginateNum,
            'allItems' => $allItems,
            'spots' => $spots,
            'searchParam' => $searchParam,
            'spotsCount' => $spotsCount,
        ];
        return view('ecospotsearch.search', $param);
    }

    public function city_search(Request $request)
    {
        if(empty($_SERVER['HTTP_REFERER'])) {
            return redirect('/');
        }
        $selectAreaNum = $request->input('area');
        $cityList = $this->service->getCityListApi($selectAreaNum);
        header("Content-type: application/json; charset=UTF-8");
        return response()->json($cityList);
    }
}