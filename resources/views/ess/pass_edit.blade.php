@extends('layouts.main')

@section('main')
    <h4>パスワードをリセットします。</h4>
    <div class="pass-edit-form">
        <form action="/" method="post"></form>
            @csrf
            <p>メールアドレス</p>
            <label>新しいパスワード<input type="password" name="pass"></label>
            <label>パスワード確認<input type="password" name="pass"></label>
            <input type="submit" class="button" value="パスワードを変更する">
        </form>
    </div>
@endsection