@extends('layouts.common')

@section('contents')
    <h2 class="title">ユーザー登録</h2>
    <div class="form">
        <form action="" method="post">
            @csrf
            <ul>
                @if($errors->has('name'))
                    エラー:{{ $errors->first('name') }}
                @endif
                <li>
                    <label>名前</label>
                    <input type="text" name="name">
                </li>
                @if($errors->has('email'))
                    エラー:{{ $errors->first('email') }}
                @endif
                <li>
                    <label>メールアドレス</label>
                    <input type="text" name="email">
                </li>
                @if($errors->has('password'))
                    エラー:{{ $errors->first('password') }}
                @endif
                <li>
                    <label>パスワード</label>
                    <input type="password" name="password">
                </li>
                @if($errors->has('password-confirm'))
                    エラー:{{ $errors->first('password-confirm') }}
                @endif
                <li>
                    <label>パスワード確認</label>
                    <input type="password" name="password_confirm">
                </li>
            </ul>
            <input type="hidden" value=0 name="admin_flg">
            <input type="hidden" value=0 name="blacklist_flg">
            <div class="btn">
                <input type="submit" value="登録する" class="button">
            </div>
        </form>
    </div>
@stop