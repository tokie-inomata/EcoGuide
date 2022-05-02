@extends('layouts.common')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@stop

@section('contents')
    <div class="title-image">
        <h1 class="main-ttl">
            資源回収ボックス検索サイト<br>
            EcoSpotSearch
        </h1>
    </div>
    <div class="wrapper">
        <div class="area-search" id="search">
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
        <div class="service-info">
            <div class="info-text">
                <p class="text">
                    身近にある資源回収ボックス<br>
                    雑誌や衣服だけじゃなく、小型金属や小型家電<br>
                    電球や電池も回収してくれるんです<br>
                    捨て方に困ってた物を、回収ボックスへ持っていきませんか？
                </p>
            </div>
            <div class="info-image">
                <img src="{{ asset('images/index_img2.jpg')}}">
            </div>
        </div>
    </div>
@stop