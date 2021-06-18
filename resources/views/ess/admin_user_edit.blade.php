@extends('layouts.main')

@section('main')
    <h2 class="admin-user-edit-title">ユーザー情報変更</h2>
    <div class="user-edit-form">
        @foreach ( $users as $user)
            @if( $user->id == $id)
                <form action="{{ route('user.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <label>名前 <input type="text" name="name" value="{{ $user->name }}"></label>
                    <label>メールアドレス<input type="text" name="email" value="{{ $user->email }}"></label>
                    <label>パスワード<input type="password" name="password"></label>
                    <label>パスワード確認<input type="password" name="pass_confirm"></label>
                    <label>管理者権限<input type="checkbox" value="1" name="admin_flg"></label>
                    <label>ブラックリスト<input type="checkbox" value="1" name="blacklist_flg"></label>
                    <input type="submit" value="変更" class="user-edit" name="edit">
                    <input type="submit" value="削除" class="user-edit" name="delete">
                </form>
            @endif
        @endforeach
    </div>
@endsection