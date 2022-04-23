@extends('layouts.common')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@stop

@section('contents')
    <h2 class="title">ユーザー登録</h2>
    <div class="form">
        <form action="{{ route('user.signup') }}" method="post">
            @csrf
            <ul>
                <li class="input-ttl">
                    <p>名前</p>
                    <input type="text" name="name">
                </li>
                <li class="input-ttl">
                    <p>メールアドレス</p>
                    <input type="text" name="email">
                </li>
                <li class="input-ttl">
                    <p>パスワード</p>
                    <input type="password" name="password">
                </li>
                <li class="input-ttl">
                    <p>パスワード確認</p>
                    <input type="password" name="password_confirm">
                </li>
            </ul>
            <div class="btn">
                <input type="submit" value="登録する" class="button">
            </div>
        </form>
    </div>
@endsection