@extends('layouts.common')

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
                <li>
                    <label>メールアドレス</label>
                    <input type="text" name="email">
                </li>
                <li>
                    <label>パスワード</label>
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