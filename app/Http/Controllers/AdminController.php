<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Spot;
use App\Recycling_item;

class AdminController extends Controller
{
    public function user_index(Request $request)
    {
        //表示件数取得
        $paginate = $request->input('paginate');
        //ログインユーザー情報取得
        $login_user = Auth::user();
        //全ユーザー情報取得
        $people = User::paginate($paginate);
        
        $param = [
            'login_user' => $login_user,
            'people' => $people,
            'paginate' => $paginate,
        ];

        return view('ess/admin_user_list', $param);
    }

    public function spot_index(Request $request)
    {
        //表示件数取得
        $paginate = $request->input('paginate');
        //ログインユーザー情報取得
        $login_user = Auth::user();
        //全スポット情報取得
        $spots = Spot::paginate($paginate);
        //全ユーザー情報取得
        $users = User::all();
        //全品目取得
        $recycling_items = Recycling_item::all();
        $param = [
            'login_user' => $login_user,
            'spots' => $spots,
            'users' => $users,
            'recycling_items' => $recycling_items,
            'paginate' => $paginate,
        ];

        return view('ess/admin_spot_list', $param);
    }

    public function user_edit(Request $request)
    {
        //全ユーザー情報取得
        $users = User::all();
        //選択されたユーザーのID取得
        $id = $request->input('id');
        $param = [
            'users' => $users,
            'id' => $id,
        ];
        return view('ess/admin_user_edit', $param);
    }

    public function blacklist(Request $request)
    {
        //表示件数取得
        $paginate = $request->input('paginate');
        //ログインユーザー情報取得
        $login_user = Auth::user();
        //ブラックリストに入ってる全ユーザー情報を取得
        $user = User::where('blacklist_flg', 1)->paginate($paginate);
        $param = [
            'login_user' => $login_user,
            'user' => $user,
            'paginate' => $paginate,
        ];

        return view('ess/blacklist', $param);
    }

    public function item_create(Request $request)
    {
        //ログインユーザー情報取得
        $login_user = Auth::user();
        //全品目情報取得
        $recycling_items = Recycling_item::all();
        $param = [
            'login_user' => $login_user,
            'recycling_items' => $recycling_items,
        ];

        return view('ess/item_add', $param);
    }

    public function item_add(Request $request)
    {
        //createが押された場合
        if(!empty($_POST['create'])){
            //新しい品目を追加する
            $recycling_item = new recycling_item;
            $recycling_item->recycling_item = $request->recycling_item;
            $recycling_item->save();

            return redirect('/admin/item/create');
        //deleteが押された場合
        } elseif(!empty($_POST['delete'])) {
            //登録されてる品目からIDを取得し削除
            Recycling_item::find($request->id)->delete();

            return redirect('/admin/item/create');
        }


    }
}
