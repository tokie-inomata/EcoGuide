@extends('layouts.user')

@section('main')
    <div id="main">
        <div class="spot-add-lists">
            <h2 class="title">登録一覧</h2>
            <div class="spot-signup">
                <a class="button spot-create-button" href="/spot/create">新規登録</a>
            </div>
            @if (empty($spot))
                <p class="not-spot">登録されているスポットがありません。</p>
            @else
                <div class="result">
                    @foreach ( $spot as $k => $val )
                        <table class="search-result">
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