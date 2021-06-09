@extends('layouts.user')

@section('main')
    <h2 class="title">ブラックリスト</h2>
    <form action="/" method="post" class="search-box">
        @csrf
        <input type="text" size="50" name="admin_blacklist_search"><input type="submit" value="検索">
    </form>
    <div class="result-number">
        <form action="/search" method="get">
            <select type="text" class="number">
                <option name="result-number" value="10">10件</option>
                <option name="result-number" value="30">30件</option>
                <option name="result-number" value="50">50件</option>
            </select>
            <input type="submit" value="表示">
        </form>
    </div>
    <div class="user-list-reslut">
        <table class="user-list-table">
            <tr>
                <th class="user-list-id">ID</th>
                <th class="user-list-name">名前</th>
                <th class="user-list-mail">メールアドレス</th>
                <th class="user-list-edit">変更</th>
            </tr>
            @foreach($user as $k => $val)
                <tr>
                    <td class="user-list-id">{{ $val['id'] }}</td>
                    <td class="user-list-name">{{ $val['name'] }}</td>
                    <td class="user-list-mail">{{ $val['mail'] }}</td>
                    <td class="user-list-edit"><a href="/" class="button admin-user-edit">変更</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection