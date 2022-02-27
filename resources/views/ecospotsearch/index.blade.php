@extends('layouts.common')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/common.js')}}"></script>
@stop

@section('contents')
    <div class="container">
        <h2>EcoSpotSearch</h2>
        <p>
            使い終わった蛍光灯や乾電池、小型家電等も回収してくれるボックスがあるのをご存じですか？<br>
            実はショッピングモールやスーパーなどで回収していたりするんです。<br>
            お買い物ついでに持って行ける場所、探してみませんか？
        </p>
    </div>
    <div class="area-search" id="search">
        <h2>エリア検索</h2>
        <div class="search">
            <div class="search-image">
                <img src="{{ asset('images/japan_map.png') }}" alt="エリア検索">
            </div>
            <div class="area hokkaidou">
                <h4 class="ttl">北海道</h4>
                <ul class="group">
                @foreach(config('pref') as $areas)
                    @if($areas['area'] == '北海道')
                    <ol class="list"><a href="/search?area={{ $areas['pref_num'] }}&paginate=10">{{ $areas['pref'] }}</a></ol>
                    @endif
                @endforeach
            </ul>
            </div>
            <div class="area touhoku">
                <h4 class="ttl">東北地方</h4>
                <ul class="group">
                @foreach(config('pref') as $areas)
                    @if($areas['area'] == '東北地方')
                            <ol class="list"><a href="/search?area={{ $areas['pref_num'] }}&paginate=10">{{ $areas['pref'] }}</a></ol>
                    @endif
                @endforeach
                </ul>
            </div>
            <div class="area kantou">
                <h4 class="ttl">関東地方</h4>
                <ul class="group">
                @foreach(config('pref') as $areas)
                    @if($areas['area'] == '関東地方')
                        <ol class="list"><a href="/search?area={{ $areas['pref_num'] }}&paginate=10">{{ $areas['pref'] }}</a></ol>
                    @endif
                @endforeach
                </ul>
            </div>
            <div class="area tyuubu">
                <h4 class="ttl">中部地方</h4>
                <ul class="group">
                @foreach(config('pref') as $areas)
                    @if($areas['area'] == '中部地方')
                        <ol class="list"><a href="/search?area={{ $areas['pref_num'] }}&paginate=10">{{ $areas['pref'] }}</a></ol>
                    @endif
                @endforeach
                </ul>
            </div>
            <div class="area kansai">
                <h4 class="ttl">関西地方</h4>
                <ul class="group">
                @foreach(config('pref') as $areas)
                    @if($areas['area'] == '関西地方')
                        <ol class="list"><a href="/search?area={{ $areas['pref_num'] }}&paginate=10">{{ $areas['pref'] }}</a></ol>
                    @endif
                @endforeach
                </ul>
            </div>
            <div class="area tyuugoku">
                <h4 class="ttl">中国地方</h4>
                <ul class="group">
                @foreach(config('pref') as $areas)
                    @if($areas['area'] == '中国地方')
                        <ol class="list"><a href="/search?area={{ $areas['pref_num'] }}&paginate=10">{{ $areas['pref'] }}</a></ol>
                    @endif
                @endforeach
                </ul>
            </div>
            <div class="area shikoku">
                <h4 class="ttl">四国地方</h4>
                <ul class="group">
                @foreach(config('pref') as $areas)
                    @if($areas['area'] == '四国地方')
                        <ol class="list"><a href="/search?area={{ $areas['pref_num'] }}&paginate=10">{{ $areas['pref'] }}</a></ol>
                    @endif
                @endforeach
                </ul>
            </div>
            <div class="area kyuusyuu">
                <h4 class="ttl">九州地方</h4>
                <ul class="group">
                @foreach(config('pref') as $areas)
                    @if($areas['area'] == '九州地方')
                        <ol class="list"><a href="/search?area={{ $areas['pref_num'] }}&paginate=10">{{ $areas['pref'] }}</a></ol>
                    @endif
                @endforeach
                </ul>
            </div>
            <div class="area okinawa">
                <h4 class="ttl">沖縄</h4>
                <ul class="group">
                @foreach(config('pref') as $areas)
                    @if($areas['area'] == '沖縄')
                        <ol class="list"><a href="/search?area={{ $areas['pref_num'] }}&paginate=10">{{ $areas['pref'] }}</a></ol>
                    @endif
                @endforeach
                </ul>
            </div>
        </div>
    </div>
@stop