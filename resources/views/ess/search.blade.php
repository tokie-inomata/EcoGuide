@extends('layouts.main')

@section('main')
    <form action="/search" method="get">
        <table class="search-area">
            <tr>
                <th>都道府県</th>
                <td class="details">
                    <select type="text" class="search-control" name="area">
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
                    <th rowspan="2">市区町村</th>
                </tr>
                <tr>
                    @foreach ( $city as $k => $val )
                        @if( $k == 'data' )
                            @foreach( $val as $k2 => $val2 )
                                @foreach( $val2 as $k3 => $val3 )
                                    @if( $k3 == 'name' )
                                        <td class="details">
                                            <input type="checkbox" name="municipality[]" value="{{ $val3 }}">{{ $val3 }}
                                        </td>
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    @endforeach
                </tr>
                <tr></tr>
                <tr>
                    <th rowspan="5">品目</th>
                    @foreach ( $items as $k => $val )
                        <td class="details">
                            <input type="checkbox" name="item[]" value="{{ $val->recycling_item }}">{{ $val->recycling_item }}
                        </td>
                    @endforeach
                </tr>
            @endif
        </table>
        <input type="hidden" name="flg" value="{{ $flg == 1 ? 0 : 1 }}">
        <input type='hidden' name="paginate" value="{{$paginate}}">
        <input type="submit" value="詳細検索" class="search-button">
    </form>

    <h2 class="title">検索結果</h2>

    <div class="result-number">
        <form action="" method="get">
            <input type="hidden" name="area" value="{{$area}}">
            <select type="text" class="number" name="paginate">
                @if($paginate == 10)
                    <option value="10" selected>10件</option>
                @else
                    <option value="10">10件</option>
                @endif
                @if($paginate == 30)
                    <option value="30" selected>30件</option>
                @else
                    <option value="30">30件</option>
                @endif
                @if($paginate == 50)
                    <option value="50" selected>50件</option>
                @else
                    <option value="50">50件</option>
                @endif
            </select>
            <input type="submit" value="表示">
        </form>
    </div>
    <div class="result">
        @if($count_spots == 0)
            <p class="not-spot">登録スポットがありません。</p>
        @elseif(!empty($spots))
            @foreach ( $spots as $spot )
                <table class="search-result spot-table">
                    <tr>
                        <th rowspan="5">
                            @if(!empty($spot->image_path))
                                <img src="{{ asset('storage/spot_image/' . $spot->image_path) }}" width="80%">
                            @else
                                <img src="{{ asset('img/EcoSpotSearch-logo.png') }}" width="50%">
                            @endif
                        </th>
                    </tr>
                    <tr><td>名前 : {{ $spot->name }}</td></tr>
                    <tr><td>住所 : {{ $spot->getData() }}</td></tr>
                    <tr>
                        <td>品目 : 
                            @foreach( $spot->recycling_items as $recycling_item )
                                {{ $recycling_item->recycling_item }}
                            @endforeach
                        </td>
                    </tr>
                </table>
            @endforeach
            {{ $spots->appends($search_param)->links() }}
        @endif
    </div>
@endsection