@extends('layouts.main')

@section('main')
    <h4>パスワードをリセットします。</h4>
    <div class="user-edit-form">
        @if(session('flash_message'))
            <div class="flash-message">
                {{ session('flash_message') }}
            </div>
        @endif
        @error('email')
            <div class="flash-message" role="alert">
                {{ $message }}
            </div>
        @enderror
        @error('password')
            <div class="flash-message" role="alert">
                {{ $message }}
            </div>
        @enderror
        <form action="{{ route('password.update') }}" method="post">
            @csrf
            <dl>
                <dt>メールアドレス</dt>
                <dd><input type="email" name="email"></dd>
                <dt>新しいパスワード</dt>
                <dd><input type="password" name="password"></dd>
                <dt>パスワード確認</dt>
                <dd><input type="password" name="password_confirmation"></dd>
            </dl>
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="submit" class="button" value="パスワードを変更する">
        </form>
    </div>
@endsection