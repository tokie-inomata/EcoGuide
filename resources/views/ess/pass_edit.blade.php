@extends('layouts.main')

@section('main')
    <h4>パスワードをリセットします。</h4>
    <div class="pass-edit-form">
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <label>メールアドレス<input type="email" name="email"></label>
            <label>新しいパスワード<input type="password" name="password"></label>
            <label>パスワード確認<input type="password" name="password_confirmation"></label>
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="submit" class="button" value="パスワードを変更する">
        </form>
    </div>
@endsection