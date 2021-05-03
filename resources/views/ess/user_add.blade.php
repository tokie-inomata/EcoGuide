@extends('layouts.main')

@section('main')
<h2 class="user_add">ユーザー登録</h2><br>
<div class="form_content">
    <form action="/" method="post" class="user_add_form"></form>
        <label>名前：<input type="text" name="name"></label><br><br>
        <label>メールアドレス：<input type="text" name="mail"></label><br><br>
        <label>パスワード：<input type="password" name="pass"></label><br><br>
        <label>パスワード確認：<input type="password" name="pass_confirm"></label><br><br>
        <input type="submit" value="登録する">
    </form>
</div>
@endsection