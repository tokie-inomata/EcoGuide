@extends('layouts.main')

@section('main')
    <h2 class="title">ログイン</h2>
    @if(session('flash_message'))
        <div class="flash-message">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="user-login">
        <form action="{{ route('user_signin') }}" method="post">
            @csrf
            <label>メールアドレス<input type="text" name="email"></label>
            <label>パスワード<input type="password" name="password"></label>
            <input type="submit" value="ログイン" class="button" name="login">
        </form>   
    </div>
    <a href="/pass/forget" class="user-pass-edit">パスワードを忘れ方はこちら</a>
@endsection