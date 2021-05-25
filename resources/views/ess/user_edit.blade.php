@extends('layouts.main')

@section('main')
    <h2 class="title">登録情報変更</h2>
    <div class="user-edit-form">
        <form action="/" method="post"></form>
            @csrf
            <label>名前<input type="text" name="name" value="{{ old('name') }}"></label>
            <label>メールアドレス<input type="text" name="mail" value="{{ old('mail') }}"></label>
            <label>パスワード<input type="password" name="pass"></label>
            <label>パスワード確認<input type="password" name="pass_confirm"></label>
            <input type="submit" value="変更" class="button user-edit" name="edit">
            <input type="submit" value="削除" class="button user-edit" name="delete">
        </form>
    </div>
@endsection