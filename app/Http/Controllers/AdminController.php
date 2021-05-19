<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin_user_list(Request $request)
    {
        $user = array(
            [
                'id' => '1',
                'name' => '田中',
                'mail' => 'tanaka@tanaka.com',
            ],
            [
                'id' => '2',
                'name' => '佐藤',
                'mail' => 'satou@satou.com',
            ],
            [
                'id' => '3',
                'name' => '山田',
                'mail' => 'yamada@yamada.com',
            ],
            [
                'id' => '4',
                'name' => '木村',
                'mail' => 'kimura@kimura.com',
            ],
            [
                'id' => '5',
                'name' => '林',
                'mail' => 'hayashi@hayashi.com',
            ],
        );

        return view('ess/admin_user_list', ['user' => $user]);
    }

    public function admin_spot_list(Request $request)
    {
        $spot = [
            [
                'name' => 'test1',
                'address' => 'test2',
                'item' => 'test3',
                'add_user' => 'test4'
            ],
            [
                'name' => 'test1',
                'address' => 'test2',
                'item' => 'test3',
                'add_user' => 'test4'
            ],
        ];

        return view('ess/admin_spot_list', ['spot' => $spot]);
    }

    public function admin_user_edit(Request $request)
    {
        return view('ess/admin_user_edit');
    }

    public function blacklist(Request $request)
    {
        $user = array(
            [
                'id' => '3',
                'name' => '山田',
                'mail' => 'yamada@yamada.com',
            ],
            [
                'id' => '5',
                'name' => '林',
                'mail' => 'hayashi@hayashi.com',
            ],
        );

        return view('ess/blacklist', ['user' => $user]);
    }
}
