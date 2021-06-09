@extends('layouts.main')

@section('main')
    <h2 class="title">ユーザー登録</h2>
    <div class="add-form">
        <form action="/user/create" method="post">
            @csrf
            @if($errors->has('name'))
                エラー:{{ $errors->first('name') }}
            @endif
            <label>名前<input type="text" name="name"></label>
            @if($errors->has('email'))
                エラー:{{ $errors->first('email') }}
            @endif
            <label>メールアドレス<input type="text" name="email"></label>
            @if($errors->has('password'))
                エラー:{{ $errors->first('password') }}
            @endif
            <label>パスワード<input type="password" name="password"></label>
            @if($errors->has('password-confirm'))
                エラー:{{ $errors->first('password-confirm') }}
            @endif
            <label>パスワード確認<input type="password" name="password_confirm"></label>
            <input type="hidden" value=0 name="admin_flg">
            <input type="hidden" value=0 name="blacklist_flg">
            <input type="submit" value="登録する" class="button">
        </form>
    </div>
@endsection