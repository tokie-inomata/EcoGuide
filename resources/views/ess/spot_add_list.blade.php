@extends('layouts.user')

@section('main')
    <div id="main">
        <div class="spot_add_lists">
            <h2 class="spot_add_list_title">登録一覧</h2>
            <div class="spot_signup">
                <a class="button spot_add_button" href="/">新規登録</a>
            </div>
            @if (empty($spot))
                <p class="not_spot">登録されているスポットがありません。</p>
            @else
                <div class="result">
                    @foreach ( $spot as $k => $val )
                        <table class="search_result">
                            <tr><th rowspan="4"><img src="/"></th></tr>
                            <tr><td>名前 : {{ $val['name'] }}</td></tr>
                            <tr><td>住所 : {{ $val['address'] }}</td></tr>
                            <tr><td>品目 : {{ $val['item'] }}</td></tr>
                        </table>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection