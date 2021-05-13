@extends('layouts.main')

@section('main')
    <div class="main_content">
        <h1>資源回収BOX検索サイト<br>Ecoスポットサーチ</h1>
    </div>
    <div class="container">
        <article class="main_article">
            <h2>Ecoスポットサーチって何？</h2>
            <p>段ボールがたくさんあったのに回収日に出すのを忘れちゃった。
            小型金属の回収日だったの忘れてた。なんてことはありませんか？
            実はこういう資源はリサイクルのためにいろいろなところに回収ボックスが置かれているんです。
            そんな回収ボックスの場所を検索するサイトが、Ecoスポットサーチなんです。
            </p>
        </article>
        <article>
            <h2>登録ボランティアを募集しています。</h2>
            <p>皆さんの近場にある回収ボックスや見かけた回収ボックスを、登録していただけるボランティアの方々を募集しています。
            ご協力いただける方はぜひユーザー登録をよろしくお願いいたします。</p>
        </article>
    </div>
    <div class="area_search">
        <h2>エリア検索</h2>
        <img src="{{ asset('img/japan_map.jpg') }}" alt="エリア検索">
        <div class="hokkaidou_area">
            @foreach(config('pref') as $k => $val)
                @if($k == '北海道')
                    <h4 class="hokkaidou">{{ $k }}</h4>
                    <ul class="area_group">
                        @foreach($val as $k2 => $val2)
                            <ol class="area_list"><a href="/search?area={{ $k2 }}">{{ $val2 }}</a></ol>     
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
        <div class="touhoku_area">
            @foreach(config('pref') as $k => $val)
                @if($k == '東北地方')
                    <h4 class="touhoku">{{ $k }}</h4>
                    <ul class="area_group">
                        @foreach($val as $k2 => $val2)
                        <ol class="area_list"><a href="/search?area={{ $k2 }}">{{ $val2 }}</a></ol>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
        <div class="kantou_area">
            @foreach(config('pref') as $k => $val)
                @if($k == '関東地方')
                    <h4 class="kantou">{{ $k }}</h4>
                    <ul class="kantou_group">
                        @foreach($val as $k2 => $val2)
                        <ol class="kantou_list"><a href="/search?area={{ $k2 }}">{{ $val2 }}</a></ol>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
        <div class="tyuubu_area">
            @foreach(config('pref') as $k => $val)
                @if($k == '中部地方')
                    <h4 class="tyuubu">{{ $k }}</h4>
                    <ul class="area_group">
                        @foreach($val as $k2 => $val2)
                        <ol class="area_list"><a href="/search?area={{ $k2 }}">{{ $val2 }}</a></ol>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
        <div class="kansai_area">
            @foreach(config('pref') as $k => $val)
                @if($k == '関西地方')
                    <h4 class="kansai">{{ $k }}</h4>
                    <ul class="area_group">
                        @foreach($val as $k2 => $val2)
                        <ol class="area_list"><a href="/search?area={{ $k2 }}">{{ $val2 }}</a></ol>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
        <div class="tyuugoku_area">
            @foreach(config('pref') as $k => $val)
                @if($k == '中国地方')
                    <h4 class="tyuugoku">{{ $k }}</h4>
                    <ul class="area_group">
                        @foreach($val as $k2 => $val2)
                        <ol class="area_list"><a href="/search?area={{ $k2 }}">{{ $val2 }}</a></ol>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
        <div class="shikoku_area">
            @foreach(config('pref') as $k => $val)
                @if($k == '四国地方')
                    <h4 class="shikoku">{{ $k }}</h4>
                    <ul class="area_group">
                        @foreach($val as $k2 => $val2)
                        <ol class="area_list"><a href="/search?area={{ $k2 }}">{{ $val2 }}</a></ol>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
        <div class="kyuusyuu_area">
            @foreach(config('pref') as $k => $val)
                @if($k == '九州地方')
                    <h4 class="kyuusyuu">{{ $k }}</h4>
                    <ul class="area_group">
                        @foreach($val as $k2 => $val2)
                        <ol class="area_list"><a href="/search?area={{ $k2 }}">{{ $val2 }}</a></ol>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
        <div class="okinawa_area">
            @foreach(config('pref') as $k => $val)
                @if($k == '沖縄')
                    <h4 class="okinawa">{{ $k }}</h4>
                    <ul class="area_group">
                        @foreach($val as $k2 => $val2)
                        <ol class="area_list"><a href="/search?area={{ $k2 }}">{{ $val2 }}</a></ol>
                        @endforeach
                    </ul>
                @endif
            @endforeach
        </div>
    </div>
@endsection