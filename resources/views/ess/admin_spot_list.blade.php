@extends('layouts.user')

@section('admin_menu')
    <a href="/admin/user/index" class="menu-list">全ユーザー一覧</a>
    <a href="/admin/spot/index" class="menu-list">全登録一覧</a>
    <a href="/blacklist" class="menu-list">ブラックリスト</a>
@endsection

@section('main')

    <h2 class="title">全登録スポット一覧</h2>
    <form action="/" method="post" class="search-box">
        @csrf
        <input type="text" size="50" name="admin_spot_search"><input type="submit" value="検索">
    </form>
        @if (empty($spot))
            <p class="not-spot">登録されているスポットがありません。</p>
        @else
            <div class="result">
                @foreach ( $spot as $k => $val )
                    <table class="search-result admin-search-result">
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