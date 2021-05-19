@extends('layouts.user')

@section('admin_menu')
    <a href="/user_list" class="menu_list">全ユーザー一覧</a>
    <a href="/spot_list" class="menu_list">全登録一覧</a>
    <a href="/" class="menu_list">ブラックリスト</a>
@endsection

@section('main')
    <form action="/" method="post">
        @csrf
        <input type="text"><input type="submit" name="user_list_search" value="検索">
    </form>
    <h2 class="admin_spot_list_title">全登録スポット一覧</h2>
            @if (empty($spot))
                <p class="not_spot">登録されているスポットがありません。</p>
            @else
                <div class="result">
                    @foreach ( $spot as $k => $val )
                        <table class="search_result">
                            <tr><th rowspan="5"><img src="/"></th></tr>
                            <tr><td>名前 : {{ $val['name'] }}</td></tr>
                            <tr><td>住所 : {{ $val['address'] }}</td></tr>
                            <tr><td>品目 : {{ $val['item'] }}</td></tr>
                            <tr><td>品目 : {{ $val['add_user'] }}</td></tr>
                        </table>
                    @endforeach
                </div>
            @endif
@endsection