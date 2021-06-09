@extends('layouts.user')

@section('main')

    <h2 class="title">全登録スポット一覧</h2>
    <form action="/" method="post" class="search-box">
        @csrf
        <input type="text" size="50" name="admin_spot_search"><input type="submit" value="検索">
    </form>
        @if (empty($spots))
            <p class="not-spot">登録されているスポットがありません。</p>
        @else
            <div class="result">
                @foreach ( $spots as $spot )
                    <table class="search-result admin-search-result">
                        <tr><th rowspan="5"><img src="/"></th></tr>
                        <tr><td>名前   : {{ $spot->name }}</td></tr>
                        <tr><td>住所   : {{ $spot->getData() }}</td></tr>
                        <tr><td>品目   : {{ $spot->recycling_items }}</td></tr>
                        <tr><td>登録者 : {{ $spot->user->name }}</td></tr>
                    </table>
                @endforeach
            </div>
        @endif
@endsection