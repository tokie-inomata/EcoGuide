@extends('layouts.main')

@section('main')
    <h2 class="title">ユーザー登録</h2>
    <div class="add-form">
        <form action="/user/create" method="post">
            @csrf
            <dl>
                @if($errors->has('name'))
                    エラー:{{ $errors->first('name') }}
                @endif
                <dt>名前</dt>
                <dd><input type="text" name="name"></dd>
                @if($errors->has('email'))
                    エラー:{{ $errors->first('email') }}
                @endif
                <dt>メールアドレス</dt>
                <dd><input type="text" name="email"></dd>
                @if($errors->has('password'))
                    エラー:{{ $errors->first('password') }}
                @endif
                <dt>パスワード</dt>
                <dd><input type="password" name="password"></dd>
                @if($errors->has('password-confirm'))
                    エラー:{{ $errors->first('password-confirm') }}
                @endif
                <dt>パスワード確認</dt>
                <dd><input type="password" name="password_confirm"></dd>
            </dl>
            <input type="hidden" value=0 name="admin_flg">
            <input type="hidden" value=0 name="blacklist_flg">
            <input type="submit" value="登録する" class="button">
        </form>
    </div>
@endsection