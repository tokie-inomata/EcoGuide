@extends('layouts.main')

@section('main')
<div class="main_content">
    <h1>資  源  回  収  B  O  X  検  索  サ  イ  ト  <br>E  c  o  ス  ポ  ッ  ト  サ  ー  チ</h1>
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
</div>
@endsection