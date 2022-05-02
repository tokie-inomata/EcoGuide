@extends('layouts.common')

@section('css')
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('css/search.css')}}">
@stop

@section('js')
    <script src="{{ asset('js/jquery.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@stop

@section('contents')
    <h2 class="content-ttl">資源回収スポット検索</h2>
    <form action="/search" method="get">
        <div class="search-form">
            <div class="prefecture-area search-area">
                <p class="search-content-ttl">都道府県</p>
                <div class="search-content">
                    <select class="area-list" name="area" id="area">
                        @foreach(config('pref') as $city)
                            <option  value="{{ $city['pref_num'] }}" {{$area == $city['pref_num'] ? 'selected' : '' }}>{{ $city['pref'] }}</option>
                        @endforeach
                    </select>
                    <span class="details-button"></span>
                </div>
            </div>
            <div class="city-area details search-area close">
                <p class="search-content-ttl">市区町村</p>
                <div class="search-content" id="city-list">
                </div>
            </div>
            <div class="item-area details search-area close">
                <p class="search-content-ttl">品目</p>
                <div class="search-content">
                    @foreach($allItems as $item)
                        <div class="item-set">
                            <input type="checkbox" name="item[]" value="{{ $item->id }}" id="item">
                            <label for="item">{{ $item->recycling_item }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <input type='hidden' name="paginate" value="{{$paginate}}">
        </div>
        <div class="button-area">
            <input type="submit" value="検索" class="search-button">
        </div>
    </form>

    <h2 class="title">検索結果</h2>

    @if($spotsCount == 0)
        <p>
            検索結果がありません。<br>
            条件を変更して検索してください。
        </p>
    @else
        @foreach($spots as $spot)
            <div class="search-result">
                <div class="result-img">
                    @if(!empty($spot->image_path) && Storage::exists('/public/spot_image/'.$spot->image_path))
                        <img src="{{ asset('storage/spot_image/' . $spot->image_path) }}">
                    @else
                        <img src="{{ asset('img/EcoSpotSearch-logo.png') }}">
                    @endif
                </div>
                <div class="result-detail">
                    <p class="text">{{$spot->name}}</p>
                    <p class="text">{{$spot->getData()}}</p>
                    <p class="text">
                        @foreach($spot->recycling_items as $item)
                            {{$item->recycling_item}}
                        @endforeach
                    </p>
                </div>
            </div>
        @endforeach
    @endif
@stop