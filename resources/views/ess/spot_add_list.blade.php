@extends('layouts.user')

@section('main')
    <div id="main">
        <div class="spot-add-lists">
            <h2 class="title">登録一覧</h2>
            <div class="spot-signup">
                <a class="spot-create-button" href="/spot/create">新規登録</a>
            </div>
            @if (!empty($spots))
                <div class="result">
                    @foreach ( $spots as $spot )
                        <table class="spot-table search-result">
                            <tr><th rowspan="4"><img src="/"></th></tr>
                            <tr><td>名前 : {{ $spot->name }}</td></tr>
                            <tr><td>住所 : {{ $spot->getData() }}</td></tr>
                            <tr><td>品目   :
                            @foreach( $spot->recycling_items as $recycling_item )
                                {{ $recycling_item->recycling_item }}
                            @endforeach
                            </td></tr>
                        </table>
                    @endforeach
                </div>
            @else
                <p class="not-spot">登録されているスポットがありません。</p>
            @endif
        </div>
    </div>
@endsection