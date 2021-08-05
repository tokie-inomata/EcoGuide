@extends('layouts.main')

@section('js')
    <script src="{{ mix('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@endsection

@section('main')
    <form action="/search" method="get">
        <table class="search-area">
            <tr>
                <th>都道府県</th>
                <td class="details">
                    <select class="search-control" name="area" id="area">
                    @foreach(config('pref') as $k => $val)
                        @foreach($val as $k2 => $val2 )
                            <option  value="{{ $k2 }}" {{$area == $k2 ? 'selected' : '' }}>{{ $val2 }}</option>
                        @endforeach
                    @endforeach
                    </select>
                </td>
            </tr>
            <tr class="details-contents">
                <th rowspan="2">市区町村</th>
            </tr>
            <tr id="city-list" class="details-contents">
            </tr>
            <tr class="details-contents">
                <th rowspan="5">品目</th>
                @foreach($items as $k => $val)
                    <td class="details">
                        <input type="checkbox" name="item[]" value="{{ $val->id }}" >{{ $val->recycling_item }}
                    </td>
                @endforeach
            </tr>
        </table>
        <input type='hidden' name="paginate" value="{{$paginate}}">
        <div class="search-buttons">
            <input type="button" value="詳細" class="search-button details-button">
            <input type="submit" value="検索" class="search-button">
        </div>
    </form>

    <h2 class="title">検索結果</h2>

    @if($count_spots == 0)
        <p class="not-spot">登録スポットがありません。</p>
    @elseif(!empty($spots))
        <div class="result-number">
            <form action="" method="get">
                <input type="hidden" name="area" value="{{$area}}">
                <select type="text" class="number" name="paginate">
                @foreach(config('const') as $k => $val)
                    @if($k == 'paginate_number')
                        @foreach($val as $k2 => $val2)
                            <option value="{{$val2}}" {{$paginate == $val2 ? 'selected' : '' }}>{{$val2}}件</option>
                        @endforeach
                    @endif
                @endforeach
                </select>
                <input type="submit" value="表示">
            </form>
        </div>
        <div class="result">
            @foreach ( $spots as $spot )
                <a href="spot/show?id={{$spot->id}}">
                    <table class="search-result spot-table" id="result-{{$spot->id}}">
                        <tr>
                            <th rowspan="5">
                                @if(!empty($spot->image_path) && Storage::exists('/public/spot_image/'.$spot->image_path))
                                    <img src="{{ asset('storage/spot_image/' . $spot->image_path) }}" width="70%">
                                @else
                                    <img src="{{ asset('img/EcoSpotSearch-logo.png') }}" width="50%">
                                @endif
                            </th>
                        </tr>
                        <tr><td>名前 : {{ $spot->name }}</td></tr>
                        <tr><td id="municipality-{{$k2}}">住所 : {{ $spot->getData() }}</td></tr>
                        <tr>
                            <td>品目 : 
                                @foreach( $spot->recycling_items as $recycling_item )
                                    {{ $recycling_item->recycling_item }}
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </a>
            @endforeach
        </div>
    @endif
@endsection