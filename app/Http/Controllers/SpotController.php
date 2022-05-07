<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SpotRequest;
use App\Spot;
use App\Recycling_item;
use App\Recycling_item_spot;
use App\Services\SearchService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SpotController extends Controller
{
    public function __construct(SearchService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $user = Auth::user();
        $spots = Spot::where('user_id',$user->id)->get();

        //スポットの数を取得
        $spotsCount = count($spots);
        // dd(Spot::where('prefecture', '岩手県')->get());


        $param = [
            'user'          => $user,
            'spots'         => $spots,
            'spotsCount'   => $spotsCount,
        ];

        return view("ecospotsearch.spot.index", $param);
    }

    public function create()
    {
        $recyclingItems = Recycling_item::all();
        $param = [
            'recyclingItems' => $recyclingItems,
        ];
        return view("ecospotsearch.spot.add", $param);
    }

    public function store(SpotRequest $request)
    {
        try {
            DB::beginTransaction();
            $spot = new Spot($request->except('prefecture', 'image_path', 'recycling_item_id'));
            $selectAreaName = $this->service->selectArea($request->prefecture);
            $spot->user_id = Auth::id();
            $spot->prefecture = $selectAreaName;
            if($request->hasFile('image_path')){
                $path = $request->file('image_path')->store('public/spot_image');
                $spot->image_path = basename($path);
            }
            $spot->save();

            $recyclingItemIds = $request->recycling_item_id;
            foreach($recyclingItemIds as $recyclingItemId) {
                $recyclingItemSpot = new Recycling_item_spot(['recycling_item_id' => $recyclingItemId]);
                $recyclingItemSpot->spot_id = $spot->id;
                $recyclingItemSpot->save();
            }

            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            throw new Exception($e);
        }

        return redirect(route('spot.index'));
    }

    public function show(Spot $spot)
    {
        return view('ecospotsearch.spot.show', ['spot' => $spot]);
    }

    public function edit(Spot $spot)
    {
        $recyclingItemSpots = Recycling_item_spot::where('spot_id', $spot->id)->get();
        foreach($recyclingItemSpots as $recyclingItemSpot) {
            $ids[] = $recyclingItemSpot->recycling_item_id;
        }
        $selectItems = Recycling_item::whereIn('id', $ids)->get();
        $otherItems = Recycling_item::whereNotIn('id', $ids)->get();
        $param = [
            'selectItems' => $selectItems,
            'otherItems' => $otherItems,
            'spot' => $spot,
        ];
        return view('ecospotsearch.spot.edit', $param);
    }

    public function update(SpotRequest $request, Spot $spot)
    {
        try {
            DB::beginTransaction();

            $spot->fill($request->except('prefecture', 'image_path', 'recycling_item_id'));

            if($request->hasFile('image_path')) {
                if(isset($spot->image_path)) {
                    $delete_image = $spot->image_path;
                    Storage::delete('public/spot_image/' . $delete_image);
                }
                $path = $request->file('image_path')->store('public/spot_image');
                $spot->image_path = basename($path);
            }

            $recycling_item_ids = $request->recycling_item_id;
            $spot->recycling_items()->sync($recycling_item_ids);

            if($spot->isDirty()) {
                $spot->save();
            }

            DB::commit();
            return redirect(route('spot.index'));
        } catch(Exception $e) {
            DB::rollBack();
            throw new Exception($e);
        }
    }

    public function destroy(Spot $spot)
    {
        Storage::delete('public/spot_image/' . $spot->image_path);
        $spot->delete();

        return redirect(route('spot.index'));
    }
}
