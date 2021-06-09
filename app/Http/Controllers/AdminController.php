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
        $login_user = Auth::user();
        $people = User::all();
        
        $param = [
            'login_user' => $login_user,
            'people' => $people,
        ];

        return view('ess/admin_user_list', $param);
    }

    public function spot_index(Request $request)
    {
        $login_user = Auth::user();
        $spots = Spot::all();
        $users = User::all();
        $param = [
            'login_user' => $login_user,
            'spots' => $spots,
            'users' => $users,
        ];

        return view('ess/admin_spot_list', $param);
    }

    public function user_edit(Request $request)
    {
        $users = User::all();
        $id = $request->input('id');
        $param = [
            'users' => $users,
            'id' => $id,
        ];
        return view('ess/admin_user_edit', $param);
    }

    public function blacklist(Request $request)
    {
        $login_user = Auth::user();
        $user = User::where('blacklist_flg', '1');
        $param = [
            'login_user' => $login_user,
            'user' => $user,
        ];


        return view('ess/blacklist', $param);
    }

    public function item_create(Request $request)
    {
        $login_user = Auth::user();
        $recycling_items = Recycling_item::all();
        $param = [
            'login_user' => $login_user,
            'recycling_items' => $recycling_items,
        ];

        return view('ess/item_add', $param);
    }

    public function item_add(Request $request)
    {
        if(!empty($_POST['create'])){
            $recycling_item = new recycling_item;
            $recycling_item->recycling_item = $request->recycling_item;
            $recycling_item->save();

            return redirect('/admin/item/create');
        } elseif(!empty($_POST['delete'])) {
            Recycling_item::find($request->id)->delete();

            return redirect('/admin/item/create');
        }


    }
}
