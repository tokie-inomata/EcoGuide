@extends('layouts.main')

@section('main')
    <h2 class="admin_user_edit_title">ユーザー情報変更</h2>
    <div class="user_edit_form">
        <form action="/" method="post"></form>
            @csrf
            <label>名前<input type="text" name="name" value="{{ old('name') }}"></label>
            <label>メールアドレス<input type="text" name="mail" value="{{ old('mail') }}"></label>
            <label>パスワード<input type="password" name="pass"></label>
            <label>パスワード確認<input type="password" name="pass_confirm"></label>
            <label>管理者権限<input type="checkbox" value="1" name="admin"></label>
            <label>ブラックリスト<input type="checkbox" value="1" name="blacklist"></label>
            <input type="submit" value="変更" class="button user_edit" name="edit">
            <input type="submit" value="削除" class="button user_edit" name="delete">
        </form>
    </div>
@endsection