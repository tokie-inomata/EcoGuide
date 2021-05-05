@extends('layouts.main')

@section('main')
<h2 class="form_title">ログイン</h2>
<div class="user_login">
    <form action="/" method="post">
        @csrf
        <label>メールアドレス<input type="text" name="mail"></label>
        <label>パスワード<input type="password" name="pass"></label>
        <input type="submit" value="ログイン" class="button">
    </form>
    
</div>
<a href="/" class="pass_change">パスワードを忘れ方はこちら</a>
@endsection