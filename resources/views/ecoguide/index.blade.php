@extends('layouts.main')

@section('title' , 'ESS')

@section('main')
<div class="container">
    <article>
        <h2>Ecoスポットサーチって何？</h2>
        <p>段ボールがたくさんあったのに回収日に出すのを忘れちゃった！？
        今日は小型金属の回収日だったの忘れてたー！なんてことはありませんか？
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
    <h2>エリアから検索</h2>
    <img src="{{ asset('img/japan_map.jpg') }}" alt="エリア検索">
</div>
@endsection