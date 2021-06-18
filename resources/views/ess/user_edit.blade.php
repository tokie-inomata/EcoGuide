@extends('layouts.main')

@section('main')
    <h2 class="title">登録情報変更</h2>
    <div class="user-edit-form">
        <form action="" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $login_user->id }}">
            <label>名前<input type="text" name="name" value="{{ $login_user->name }}"></label>
            <label>メールアドレス<input type="text" name="email" value="{{ $login_user->email }}"></label>
            <label>パスワード<input type="password" name="password"></label>
            <label>パスワード確認<input type="password" name="password_confirm"></label>
            <input type="hidden" name="admin_flg" value="{{ $login_user->admin_flg }}">
            <input type="hidden" name="blacklist_flg" value="{{ $login_user->blacklist_flg }}">
            <input type="submit" value="変更" class="button user-edit" name="edit">
            <input type="submit" value="削除" class="button user-edit" name="delete">
        </form>
    </div>
@endsection