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
        <h2 class="site-ttl">EcoSpotSearch</h2>
        <div class="site-details">
            <p class="site-text">
                使い終わった蛍光灯や乾電池、小型家電等も回収してくれるボックスがあるのをご存じですか？<br>
                実はショッピングモールやスーパーなどで回収していたりするんです。<br>
                お買い物ついでに持って行ける場所、探してみませんか？
            </p>
        </div>
    </div>
    <div class="area-search" id="search">
        <h2 class="content-ttl">エリア検索</h2>
        <div class="search">
            <div class="search-image">
                <img src="{{ asset('images/japan_map.png') }}" alt="エリア検索">
            </div>
            @foreach($prefectures as $prefecture => $areas)
                <div class="area">
                    <h4 class="ttl">{{$prefecture}}</h4>
                    <ul class="group">
                        @foreach($areas as $area)
                        <ol class="list"><a href="/search?area={{ $area['pref_num'] }}&paginate=10">{{ $area['pref'] }}</a></ol>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
@stop