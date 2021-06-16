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
        //ログインユーザー情報取得
        $login_user = Auth::user();
        //全スポット情報取得
        $spots = Spot::all();
        $param = [
            'login_user' => $login_user,
            'spots' => $spots,
        ];
        return view("ess.spot_add_list", $param);
    }

    public function create(Request $request)
    {
        //全品目情報取得
        $recycling_item = Recycling_item::all();
        //ログインユーザのID取得
        $users_id = Auth::id();
        $param = [
            'recycling_item' => $recycling_item,
            'users_id' => $users_id,
        ];
        return view("ess/spot_add", $param);
    }

    public function add(SpotRequest $request)
    {
        //新しくスポット情報を登録
        $spot               = new Spot;
        $spot->name         = $request->name;
        $spot->user_id     = $request->users_id;
        $spot->prefecture   = $request->prefecture;
        $spot->city         = $request->city;
        $spot->house_number = $request->house_number;
        $spot->save();

        //選択された品目IDを取得
        $recycling_item_ids = $request->recycling_item_id;
        foreach( $recycling_item_ids as $recycling_item_id)
        {
            //選択された品目IDを中間テーブルに登録
            $recycling_item_spot = new Recycling_item_spot;
            $recycling_item_spot->spot_id = $spot->id;
            $recycling_item_spot->recycling_item_id = $recycling_item_id;
            $recycling_item_spot->save();
        }
        return redirect('/spot/index');
    }

    public function edit(Request $request)
    {
        //全品目情報取得
        $recycling_item = Recycling_item::all();
        //全スポット情報取得
        $spots = Spot::all();
        //選択されたスポットのID
        $search_id = $request->input('id');

        $param = [
            'recycling_item' => $recycling_item,
            'spots' => $spots,
            'search_id' => $search_id,
        ];

        return view("ess/spot_edit", $param);
    }

    public function updata(Request $request)
    {
        //editが押された場合
        if(!empty($_POST['edit']))
        {
            //全スポットから選択されたスポットIDを検索して更新
            $spot = Spot::find($request->id);
            $spot->name = $request->name;
            $spot->user_id = $request->user_id;
            $spot->prefecture = $request->prefecture;
            $spot->city = $request->city;
            $spot->house_number = $request->house_number;
            $spot->save();
            
            //選択された品目がある場合
            if(!empty($request->recycling_item_id)){
                //中間テーブルの情報を更新
                $recycling_item_ids = $request->recycling_item_id;
                $spot->recycling_items()->sync($recycling_item_ids);
            }

            
            return redirect('/spot/index');
        //deleteが押された場合
        } elseif(!empty($_POST['delete'])) {
            //全スポットから選択されたスポットIDを検索して削除
            Spot::find($request->id)->delete();

            return redirect('/spot/index');
        }
    }

    public function show(Request $request)
    {
        //全スポット情報取得
        $spots = Spot::all();
        //選択されたスポットIDを取得
        $search_id = $request->input('id');

        $param = [
            'spots' => $spots,
            'search_id' => $search_id,
        ];

        return view('ess/spot_show', $param);
    }
}
