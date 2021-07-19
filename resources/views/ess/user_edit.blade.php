@extends('layouts.main')

@section('js')
    <script src="{{ mix('js/app.js') }}" defer></script>
@endsection

@section('main')
    <h2 class="title">登録情報変更</h2>
    <div class="user-edit-form">
        <form action="" method="post" name="user-edit-form">
            @csrf
            <input type="hidden" name="id" value="{{ $login_user->id }}">
            <dl>
                <dt>名前</dt>
                <dd><input type="text" name="name" value="{{ $login_user->name }}"></dd>
                <dt>メールアドレス</dt>
                <dd><input type="text" name="email" value="{{ $login_user->email }}"></dd>
                <dt>パスワード</dt>
                <dd><input type="password" name="password"></dd>
                <dt>パスワード確認</dt>
                <dd><input type="password" name="password_confirm"></dd>
            </dl>
            <input type="hidden" name="admin_flg" value="{{ $login_user->admin_flg }}">
            <input type="hidden" name="blacklist_flg" value="{{ $login_user->blacklist_flg }}">
            <div class="submit-button">
                <input type="submit" value="変更" class="user-edit" name="edit">
                <input type="submit" value="削除" class="user-edit delete" name="delete">
            </div>
        </form>
    </div>
@endsection