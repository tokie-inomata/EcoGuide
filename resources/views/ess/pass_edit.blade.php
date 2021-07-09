@extends('layouts.main')

@section('main')
    <h4>パスワードをリセットします。</h4>
    <div class="user-edit-form">
        <form action="{{ route('password.update') }}" method="post">
            @csrf
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
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