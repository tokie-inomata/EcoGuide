<?php

namespace App\Services;

use App\Recycling_item;
use App\Spot;

class SearchService
{
    public function selectArea(int $area)
    {
        foreach(config('pref') as $k) {
            if($k['pref_num'] == $area) {
                $selectArea = $k['pref'];
            }
        }
        return $selectArea;
    }

    public function getCityListApi(int $area)
    {
        $header = ["X-API-KEY: 6lqPOe7CIQANL6DJWJ1JpnKf0QbAhm3D0Y3kwb1t"];
        $url = 'https://opendata.resas-portal.go.jp/api/v1/cities?prefCode='. $area;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        $cityList = json_decode($response,true)['result'];
        return $cityList;
    }

    public function selectCity(array $citys, int $selectCityNum)
    {
        foreach($citys as $city) {
            foreach($city as $cityCode => $cityName) {
                if($cityCode == $selectCityNum) {
                    $selectCityName = $cityName;
                }
            }
        }
        return $selectCityName;
    }

    public function selectItem(array $selectItemIds)
    {
        $items = Recycling_item::all();
        foreach($items as $item){
            foreach($selectItemIds as $key => $selectItemId){
                if($item->id == $selectItemId) {
                    $selectItemName[] = $item->recycling_item;
                }
            }
        }
        return $selectItemName;
    }

    public function allSearch(string $selectAreaName, array $selectItemName, string $selectCityName, int $paginateNum)
    {
        $spots = Spot::where('prefecture', $selectAreaName)
                ->Where(function($query) use ($selectCityName) {
                        $query->where('city', 'like', '%'.$selectCityName.'%');
                })
            ->WhereHas('recycling_items', function($query) use ($selectItemName) {
                    $query->whereIn('recycling_item', $selectItemName);
                })
            ->paginate($paginateNum)->all();
        return $spots;
    }

    public function allParam(int $selectAreaNum, array $selectItemIds, int $selectCityNum, int $paginateNum)
    {
        return [
            'area'        => $selectAreaNum,
            'municipality'=> $selectCityNum,
            'item'        => $selectItemIds,
            'paginate'    => $paginateNum,
        ];
    }

    public function cityOnlySearch(string $selectAreaName, string $selectCityName, int $paginateNum)
    {
        $spots = Spot::where('prefecture', $selectAreaName)
            ->where(function($query) use ($selectCityName) {
                    $query->where('city', 'like', '%'.$selectCityName.'%');
            })
            ->paginate($paginateNum)->all();
            return $spots;
    }

    public function cityOnlyParam(int $selectAreaNum, int $selectCityNum, int $paginateNum)
    {
        return [
            'area'        => $selectAreaNum,
            'municipality'=> $selectCityNum,
            'paginate'    => $paginateNum,
        ];
    }

    public function itemOnlySearch(string $selectAreaName, array $selectItemName, int $paginateNum)
    {
        $spots = Spot::where('prefecture', $selectAreaName)
                ->whereHas('recycling_items', function($query) use ($selectItemName) {
                        $query->whereIn('recycling_item', $selectItemName);
                    })
                ->paginate($paginateNum)->all();
        return $spots;
    }

    public function itemOnlyParam($selectAreaNum, $selectItemIds, $paginateNum)
    {
        return [
            'area'        => $selectAreaNum,
            'item'        => $selectItemIds,
            'paginate'    => $paginateNum,
        ];
    }
}