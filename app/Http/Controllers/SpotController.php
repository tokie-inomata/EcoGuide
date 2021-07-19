<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
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

        //ログインユーザーが作成したスポット情報取得
        $spots = Spot::where('user_id',$login_user->id)->get();

        //スポットの数を取得
        $spots_count = count($spots);

        $param = [
            'login_user'  => $login_user,
            'spots'       => $spots,
            'spots_count' => $spots_count,
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
        foreach(config('pref') as $k => $val) {
            foreach($val as $k2 => $val2) {
                if($k2 == $request->prefecture) {
                    $add_pref = $val2;
                }
            }
        }
        //新しくスポット情報を登録
        $spot               = new Spot;
        $spot->name         = $request->name;
        $spot->user_id      = $request->users_id;
        $spot->prefecture   = $add_pref;
        $spot->city         = $request->city;
        $spot->house_number = $request->house_number;
        $spot->etc          = $request->etc;
        if($request->hasFile('image_path')){
            $path = $request->file('image_path')->store('public/spot_image');
            $spot->image_path = basename($path);
        }
        $spot->save();

        //選択された品目IDを取得
        $recycling_item_ids = $request->recycling_item_id;
        if(!empty($recycling_item_ids)) {
            foreach( $recycling_item_ids as $recycling_item_id)
            {
                //選択された品目IDを中間テーブルに登録
                $recycling_item_spot = new Recycling_item_spot;
                $recycling_item_spot->spot_id = $spot->id;
                $recycling_item_spot->recycling_item_id = $recycling_item_id;
                $recycling_item_spot->save();
            }            
        }

        return redirect('/spot/index')->with('flash_message', '回収スポットを登録しました。');
    }

    public function edit(Request $request)
    {
        //全品目情報取得
        $recycling_item = Recycling_item::all();
        //選択されたスポットのID
        $search_id = $request->input('id');
        //選択されたspot情報取得
        $spots = Spot::where('id',$search_id)->get();

        $param = [
            'recycling_item' => $recycling_item,
            'spots' => $spots,
            'search_id' => $search_id,
        ];

        return view("ess/spot_edit", $param);
    }

    public function branch(SpotRequest $request)
    {
        //editが押された場合
        if(!empty($_POST['edit']))
        {
            return $this->updata($request);
        //deleteが押された場合
        } elseif(!empty($_POST['delete'])) {
            return $this->destroy($request);
        }
    }

    public function show(Request $request)
    {
        //選択されたスポットIDを取得
        $search_id = $request->input('id');
        $spots = Spot::where('id', $search_id)->get();

        $param = [
            'spots' => $spots,
            'search_id' => $search_id,
        ];

        return view('ess/spot_show', $param);
    }

    public function updata($request)
    {
        foreach(config('pref') as $k => $val) {
            foreach($val as $k2 => $val2) {
                if($k2 == $request->prefecture) {
                    $edit_pref = $val2;
                }
            }
        }
        //全スポットから選択されたスポットIDを検索して更新
        $spot = Spot::find($request->id);
        $spot->name = $request->name;
        $spot->user_id = $request->user_id;
        $spot->prefecture = $edit_pref;
        $spot->city = $request->city;
        $spot->house_number = $request->house_number;
        $spot->etc          = $request->etc;
        if($request->hasFile('image_path')) {
            if(!empty($spot->image_path)) {
                $delete_image = $spot->image_path;
                Storage::delete('public/spot_image/' . $delete_image);
            }
            $path = $request->file('image_path')->store('public/spot_image');
            $spot->image_path = basename($path);
        }


        $recycling_item_spot = Recycling_item_spot::where('spot_id',$spot->id)->get();
        foreach($recycling_item_spot as $k => $val) {
            $before_item[] = $val->recycling_item_id;
        }
        //中間テーブルの情報を更新
        $recycling_item_ids = $request->recycling_item_id;
        $spot->recycling_items()->sync($recycling_item_ids);

        if($spot->isDirty() || !empty($before_item) && $before_item != $recycling_item_ids || empty($before_item) && !empty($recycling_item_ids)) {
            $spot->save();
            return redirect('/spot/index')->with('flash_message', 'スポット情報を変更しました。');
        } else {
            return redirect('/spot/index')->with('flash_message', 'スポット情報の変更をしていません。');
        }
    }

    public function destroy($request)
    {
        //全スポットから選択されたスポットIDを検索
        $spot = Spot::find($request->id);
        //画像パスを取得してストレージ内から削除
        $delete_image = $spot->image_path;
        Storage::delete('public/spot_image/' . $delete_image);
        //スポット情報を削除する
        $spot->delete();

        return redirect('/spot/index')->with('flash_message', '登録スポットを削除しました。');
    }
}
