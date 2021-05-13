@extends('layouts.main')

@section('main')
    <form action="/search" method="get">
        <table class="search_area">
            <tr>
                <th>都道府県</th>
                <td>
                    <select type="text" class="search_control" name="area">
                    @foreach(config('pref') as $k => $val)
                        @foreach($val as $k2 => $val2 )
                            @if($area == $k2)
                                <option value="{{ $k2 }}" selected>{{ $val2 }}</option>
                            @else
                                <option value="{{ $k2 }}">{{ $val2 }}</option>
                            @endif
                        @endforeach
                    @endforeach
                    </select>
                </td>
            </tr>
            @if ($request->flg == 1)
                <tr>
                    <th rowspan="{{ count($city) / 2 }}">市区町村</th>
                </tr>
                <tr>
                    @foreach ( $city as $k => $val )
                        <td class="details">
                            <input type="radio" name="municipality" value="{{ $val }}">{{ $val }}
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th rowspan="{{ count($item) / 2 }}">品目</th>
                    @foreach ( $item as $k => $val )
                        <td class="details">
                            <input type="checkbox" name="item" value="{{ $val }}">{{ $val }}
                        </td>
                    @endforeach
                </tr>
            @endif
        </table>
        <input type="hidden" name="flg" value="{{ $flg == 1 ? 0 : 1 }}">
        <input type="submit" value="詳細検索" class="search_button">
    </form>

    <h2 class="result_title">検索結果</h2>

    @if(empty($spot))
        <p class="not_spot">登録されているスポットがありません。</p>
    @else
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
    @endif

    <div class="result">
        @foreach ( $spot as $k => $val )
            <table class="search_result">
                <tr><th rowspan="5"><img src="/"></th></tr>
                <tr><td>名前 : {{ $val['name'] }}</td></tr>
                <tr><td>住所 : {{ $val['address'] }}</td></tr>
                <tr><td>品目 : {{ $val['item'] }}</td></tr>
            </table>
        @endforeach
    </div>
@endsection