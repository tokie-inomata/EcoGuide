<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SpotRequest;
use App\User;
use App\Spot;
use App\Recycling_item;
use App\Recycling_item_spot;

class SpotController extends Controller
{
    
    public function index(Request $request)
    {
        $login_user = Auth::user();
        $spots = Spot::all();
        $param = [
            'login_user' => $login_user,
            'spots' => $spots,
        ];
        return view("ess.spot_add_list", $param);
    }

    public function create(Request $request)
    {
        $recycling_item = Recycling_item::all();
        $users_id = Auth::id();
        $param = [
            'recycling_item' => $recycling_item,
            'users_id' => $users_id,
        ];
        return view("ess/spot_add", $param);
    }

    public function add(SpotRequest $request)
    {
        $spot               = new Spot;
        $spot->name         = $request->name;
        $spot->user_id     = $request->users_id;
        $spot->prefecture   = $request->prefecture;
        $spot->city         = $request->city;
        $spot->house_number = $request->house_number;
        $spot->save();

        $recycling_item_spots = $request->recycling_item_id;
        foreach( $recycling_item_spots as $recycling_items_spot)
        {
            $recycling_item_spot = new Recycling_item_spot;
            $recycling_item_spot->spot_id = $spot->id;
            $recycling_item_spot->recycling_item_id = $recycling_items_spot;
            $recycling_item_spot->save();
        }
        return redirect('/spot/index');
    }

    public function edit(Request $request)
    {
        $recycling_item = Recycling_item::all();

        return view("ess/spot_edit", ['recycling_item' => $recycling_item]);
    }
}
