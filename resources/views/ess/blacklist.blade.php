@extends('layouts.user')

@section('admin_menu')
    <a href="/user_list" class="menu_list">全ユーザー一覧</a>
    <a href="/spot_list" class="menu_list">全登録一覧</a>
    <a href="/" class="menu_list">ブラックリスト</a>
@endsection

@section('main')
    <form action="/" method="post">
        @csrf
        <input type="text"><input type="submit" name="blacklist_search" value="検索">
    </form>
    <h2 class="blacklist_title">ブラックリスト</h2>
    <div class="result_number">
        <form action="/search" method="get">
            <select type="text" class="number">
                <option name="result_number" value="10">10件</option>
                <option name="result_number" value="30">30件</option>
                <option name="result_number" value="50">50件</option>
            </select>
            <input type="submit" value="表示">
        </form>
    </div>
    <div class="user_list_reslut">
        <table class="user_list_table">
            <tr>
                <th class="user_list_id">ID</th>
                <th class="user_list_name">名前</th>
                <th class="user_list_mail">メールアドレス</th>
                <th class="user_list_edit">変更</th>
            </tr>
            @foreach($user as $k => $val)
                <tr>
                    <td class="user_list_id">{{ $val['id'] }}</td>
                    <td class="user_list_name">{{ $val['name'] }}</td>
                    <td class="user_list_mail">{{ $val['mail'] }}</td>
                    <td class="user_list_edit"><a href="/" class="button admin_user_edit">変更</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection