@extends('layouts.main')

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/scroll.js')}}"></script>
@endsection

@section('main')
    <div class="container">
        <!-- <div class="first-article-area">
            <article class="first-article">
                <h2>Ecoスポットサーチって何？</h2>
                <p>段ボールがたくさんあったのに回収日に出すのを忘れちゃった。<br>
                小型金属の回収日だったの忘れてた。なんてことはありませんか？<br>
                実はこういう資源はリサイクルのためにいろいろなところに回収ボックスが置かれているんです。
                そんな回収ボックスの場所を検索するサイトが、Ecoスポットサーチなんです。
                </p>
            </article>
            <img src="{{ asset('img/first-article.jpg') }}" class="first-article-image">
        </div>
        <div class="second-article-area">
            <article class="second-article">
                <h2>登録ボランティアを募集しています。</h2>
                <p>皆さんの近場にある回収ボックスや見かけた回収ボックスを<br>登録していただけるボランティアの方々を募集しています。<br>
                ご協力いただける方はぜひユーザー登録をよろしくお願いいたします。</p>
            </article>
            <img src="{{ asset('img/second-article.jpg') }}" class="second-article-image">
        </div> -->
        <!-- <img src="{{ asset('img/index_img.jpg') }}" alt="資源回収ボックス"> -->
        <h2>EcoSpotSearch</h2>
        <p>
            使い終わった蛍光灯や乾電池、小型家電等も回収してくれるボックスがあるのをご存じですか？<br>
            実はショッピングモールやスーパーなどで回収していたりするんです。<br>
            お買い物ついでに持って行ける場所、探してみませんか？
        </p>
    </div>
    <div class="area-search" id="search">
        <h2>エリア検索</h2>
        <div class="area-search-container">
            <div class="search-image">
                <img src="{{ asset('img/japan_map.jpg') }}" alt="エリア検索">
            </div>
            <div class="hokkaidou-area">
                @foreach(config('pref') as $k => $val)
                    @if($k == '北海道')
                        <h4 class="hokkaidou">{{ $k }}</h4>
                        <ul class="area-group">
                            @foreach($val as $k2 => $val2)
                                <ol class="area-list"><a href="/search?area={{ $k2 }}&paginate=10">{{ $val2 }}</a></ol>     
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </div>
            <div class="touhoku-area">
                @foreach(config('pref') as $k => $val)
                    @if($k == '東北地方')
                        <h4 class="touhoku">{{ $k }}</h4>
                        <ul class="area-group">
                            @foreach($val as $k2 => $val2)
                            <ol class="area-list"><a href="/search?area={{ $k2 }}&paginate=10">{{ $val2 }}</a></ol>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </div>
            <div class="kantou-area">
                @foreach(config('pref') as $k => $val)
                    @if($k == '関東地方')
                        <h4 class="kantou">{{ $k }}</h4>
                        <ul class="kantou-group">
                            @foreach($val as $k2 => $val2)
                            <ol class="kantou-list"><a href="/search?area={{ $k2 }}&paginate=10">{{ $val2 }}</a></ol>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </div>
            <div class="tyuubu-area">
                @foreach(config('pref') as $k => $val)
                    @if($k == '中部地方')
                        <h4 class="tyuubu">{{ $k }}</h4>
                        <ul class="area-group">
                            @foreach($val as $k2 => $val2)
                            <ol class="area-list"><a href="/search?area={{ $k2 }}&paginate=10">{{ $val2 }}</a></ol>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </div>
            <div class="kansai-area">
                @foreach(config('pref') as $k => $val)
                    @if($k == '関西地方')
                        <h4 class="kansai">{{ $k }}</h4>
                        <ul class="area-group">
                            @foreach($val as $k2 => $val2)
                            <ol class="area-list"><a href="/search?area={{ $k2 }}&paginate=10">{{ $val2 }}</a></ol>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </div>
            <div class="tyuugoku-area">
                @foreach(config('pref') as $k => $val)
                    @if($k == '中国地方')
                        <h4 class="tyuugoku">{{ $k }}</h4>
                        <ul class="area-group">
                            @foreach($val as $k2 => $val2)
                            <ol class="area-list"><a href="/search?area={{ $k2 }}&paginate=10">{{ $val2 }}</a></ol>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </div>
            <div class="shikoku-area">
                @foreach(config('pref') as $k => $val)
                    @if($k == '四国地方')
                        <h4 class="shikoku">{{ $k }}</h4>
                        <ul class="area-group">
                            @foreach($val as $k2 => $val2)
                            <ol class="area-list"><a href="/search?area={{ $k2 }}&paginate=10">{{ $val2 }}</a></ol>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </div>
            <div class="kyuusyuu-area">
                @foreach(config('pref') as $k => $val)
                    @if($k == '九州地方')
                        <h4 class="kyuusyuu">{{ $k }}</h4>
                        <ul class="area-group">
                            @foreach($val as $k2 => $val2)
                            <ol class="area-list"><a href="/search?area={{ $k2 }}&paginate=10">{{ $val2 }}</a></ol>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </div>
            <div class="okinawa-area">
                @foreach(config('pref') as $k => $val)
                    @if($k == '沖縄')
                        <h4 class="okinawa">{{ $k }}</h4>
                        <ul class="area-group">
                            @foreach($val as $k2 => $val2)
                            <ol class="area-list"><a href="/search?area={{ $k2 }}&paginate=10">{{ $val2 }}</a></ol>
                            @endforeach
                        </ul>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection