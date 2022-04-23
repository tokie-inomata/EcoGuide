@extends('adminlte::page')

@section('title', '管理画面 ユーザー情報変更')

@section('content')
    <h2 class="title">ユーザー情報変更</h2>
    <div class="form">
        <form action="{{ route('user.update', $user->id) }}" method="post">
            @csrf
            @method('patch')
            <ul>
                <li class="input-ttl">
                    <p>名前</p>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}">
                </li>
                <li class="input-ttl">
                    <p>メールアドレス</p>
                    <input type="text" name="email" value="{{ old('email', $user->email) }}">
                </li>
                <li class="input-ttl">
                    <p>パスワード</p>
                    <input type="password" name="password" autocomplete="off">
                </li>
                <li class="input-ttl">
                    <p>パスワード確認</p>
                    <input type="password" name="password_confirm" autocomplete="off">
                </li>
            </ul>
            <div class="btn">
                <input type="submit" value="登録する" class="button">
            </div>
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/common.css')}}">
@stop