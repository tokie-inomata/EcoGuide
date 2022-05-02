@extends('layouts.common')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@stop

@section('contents')
    <h2 class="title">ログイン</h2>
    <div class="form">
        @if(session('flash_message'))
            <div class="flash-message">
                {{ session('flash_message') }}
            </div>
        @endif
        <form action="{{ route('user.signin') }}" method="post">
            @csrf
            <ul>
                <li class="input-ttl">
                    <p>メールアドレス</p>
                    <input type="text" name="email">
                </li>
                <li class="input-ttl">
                    <p>パスワード</p>
                    <input type="password" name="password">
                </li>
            </ul>
            <div class="btn">
                <input type="submit" value="ログイン" class="button" name="login">
                <span>パスワードを忘れた方は<a href="/pass/forget" class="user-pass-edit">こちら</a></span>
            </div>
        </form>
    </div>
@stop