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
        //検索ワードの値を取得
        $admin_user_search = $request->input('admin_user_search');
        if(!empty($admin_user_search)) {
        //検索ワードから条件の合うユーザー情報を取得
            $user = User::where('id',$admin_user_search)
                        ->orWhere('name', 'like', '%'.$admin_user_search.'%')
                        ->orWhere('email', 'like', '%'.$admin_user_search.'%')
                        ->paginate($paginate);
        } else {
        //全ユーザー情報取得
            $user = User::paginate($paginate);
        }
        //ページリンク時のGETパラメータ保持用パラメータ
        $search_param = [
            'admin_user_search' => $admin_user_search,
            'paginate'          => $paginate,
        ];

        $param = [
            'login_user' => $login_user,
            'user'       => $user,
            'paginate'   => $paginate,
            'search_param'    => $search_param,
        ];

        return view('ess/admin_user_list', $param);
    }

    public function spot_index(Request $request)
    {
        //表示件数取得
        $paginate = $request->input('paginate');
        //ログインユーザー情報取得
        $login_user = Auth::user();
        //検索ワードの値を取得
        $admin_spot_search = $request->input('admin_spot_search');
        if(!empty($admin_spot_search)) {
        //検索ワードの条件に合うスポット情報を取得
            $spots = Spot::where('id', $admin_spot_search)
                        ->orWhere('name', 'like', '%'.$admin_spot_search.'%')
                        ->orWhere('prefecture', 'like', '%'.$admin_spot_search.'%')
                        ->orWhere('city', 'like', '%'.$admin_spot_search.'%')
                        ->orWhere('house_number', 'like', '%'.$admin_spot_search.'%')
                        ->orWhereHas('recycling_items', function($query) use ($admin_spot_search) {
                            $query->Where('recycling_item', 'like', '%'.$admin_spot_search.'%');
                        })
                        ->orWhereHas('user', function($query) use ($admin_spot_search) {
                            $query->Where('name', 'like', '%'.$admin_spot_search.'%');
                        })
                        ->paginate($paginate);
        } else {
        //全スポット情報を取得
            $spots = Spot::paginate($paginate);
        }
        //ページリンク時のGETパラメータ保持用パラメータ
        $search_param = [
            'admin_spot_search' => $admin_spot_search,
            'paginate'          => $paginate,
        ];
        $param = [
            'login_user'      => $login_user,
            'spots'           => $spots,
            'paginate'        => $paginate,
            'search_param'    => $search_param,
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
        //検索ワードを取得
        $admin_blacklist_search = $request->input('admin_blacklist_search');
        if(!empty($admin_blacklist_search)) {
        //検索ワードの条件に合うブラックリストユーザーを取得
            $user = User::Where('id', $admin_blacklist_search)
                        ->orWhere('name', 'like', '%'.$admin_blacklist_search.'%')
                        ->orWhere('email', 'like', '%'.$admin_blacklist_search.'%')
                        ->paginate($paginate);
        } else {
        //ブラックリストに入ってる全ユーザー情報を取得
            $user = User::where('blacklist_flg', 1)->paginate($paginate);
        }
        //ページリンク時のGETパラメータ保持用パラメータ
        $search_param = [
            'admin_blacklist_search' => $admin_blacklist_search,
            'paginate'               => $paginate,
        ];
        $param = [
            'login_user' => $login_user,
            'user'       => $user,
            'paginate'   => $paginate,
            'search_param'    => $search_param,
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
            $rules = [
                'recycling_item' => 'required',
            ];
            $messages = [
                'recycling_item.required' => '１文字以上で入力してください。',
            ];
            $this->validate($request,$rules,$messages);
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
