@extends('layouts.main')

@section('js')
    <script src="{{ mix('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script type="module" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@endsection

@section('main')
    <h2 class="title">ユーザー情報変更</h2>
    <div class="user-edit-form">
        @foreach($users as $user)
            @if($user->id == $id)
                <form action="{{ route('user.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <dl>
                        <dt>名前</dt>
                        <dd><input type="text" name="name" value="{{ $user->name }}"></dd>
                        <dt>メールアドレス</dt>
                        <dd><input type="text" name="email" value="{{ $user->email }}"></dd>
                        <dt>パスワード</dt>
                        <dd><input type="password" name="password"></dd>
                        <dt>パスワード確認</dt>
                        <dd><input type="password" name="pass_confirm"></dd>
                        <dt>管理者権限</dt>
                        <dd><input type="checkbox" value="1" name="admin_flg" {{$user->admin_flg == 1 ? 'checked' : ''}}></dd>
                        <dt>ブラックリスト</dt>
                        <dd><input type="checkbox" value="1" name="blacklist_flg" {{$user->blacklist_flg == 1 ? 'checked' : ''}}></dd>
                    </dl>
                    <input type="submit" value="変更" class="submit-button button" name="edit">
                    <input type="submit" value="削除" class="submit-button button delete" name="delete">
                </form>
            @endif
        @endforeach
    </div>
@endsection