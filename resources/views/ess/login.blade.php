@extends('layouts.main')

@section('main')
    <h2 class="title">ログイン</h2>
    <div class="user-login">
        <form action="{{ route('user_signin') }}" method="post">
            @csrf
            <label>メールアドレス<input type="text" name="email"></label>
            <label>パスワード<input type="password" name="password"></label>
            <input type="submit" value="ログイン" class="button" name="login">
        </form>   
    </div>
    <a href="/" class="user-pass-edit">パスワードを忘れ方はこちら</a>
@endsection