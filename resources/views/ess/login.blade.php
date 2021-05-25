@extends('layouts.main')

@section('main')
    <h2 class="title">ログイン</h2>
    <div class="user-login">
        <form action="/" method="post">
            @csrf
            <label>メールアドレス<input type="text" name="mail"></label>
            <label>パスワード<input type="password" name="pass"></label>
            <input type="submit" value="ログイン" class="button">
        </form>   
    </div>
    <a href="/" class="user-pass-edit">パスワードを忘れ方はこちら</a>
@endsection