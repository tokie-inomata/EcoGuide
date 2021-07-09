@extends('layouts.main')

@section('main')
    <h4>パスワードを変更用URLを送ります。</h4>
    <div class="user-edit-form">
        @if(session('flash_message'))
            <div class="flash-message">
                {{ session('flash_message') }}
            </div>
        @endif
        <form action="{{ route('password.email') }}" method="post">
            @csrf

            <dl>
                <dt>登録メールアドレス</dt>
                <dd><input type="text" name="email"></dd>
            </dl>
            <input type="submit" class="button" value="パスワードを変更する">
        </form>
    </div>
@endsection