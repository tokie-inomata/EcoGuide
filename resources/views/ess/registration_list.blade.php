@extends('layouts.user')

@section('main')
<div id="main">
    <div class="registration_lists">
        <h2 class="result">登録一覧</h2>
            <div class="sign_up">
                <a class="button place_registration" href="/">新規登録</a>
            </div>
        <table class="search_result registration">
            <tr><th rowspan="6"><img src="/"></th><td></td></tr>
            <tr><td>名前 :</td></tr>
            <tr><td>住所 :</td></tr>
            <tr><td>品目 :</td></tr>
            <tr><td></td></tr>
        </table>
    </div>
</div>

@endsection