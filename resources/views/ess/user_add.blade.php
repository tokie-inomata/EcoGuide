@extends('layouts.main')

@section('main')
    <h2 class="user_add_title">ユーザー登録</h2>
    <div class="add_form">
        <form action="/" method="post"></form>
            @csrf
            <label>名前<input type="text" name="name"></label>
            <label>メールアドレス<input type="text" name="mail"></label>
            <label>パスワード<input type="password" name="pass"></label>
            <label>パスワード確認<input type="password" name="pass_confirm"></label>
            <input type="submit" value="登録する" class="button">
        </form>
    </div>
@endsection