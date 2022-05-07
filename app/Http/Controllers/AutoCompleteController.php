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
        $selectAreaNum = $request->input('pref');
        $cityInArea = $this->service->getCityListApi($selectAreaNum);
        foreach($cityInArea as $city) {
            $cityList[] = $city['cityName'];
        }
        return response()->json($cityList);
    }
}
