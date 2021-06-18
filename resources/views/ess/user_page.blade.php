@extends('layouts.user')

@section('main')
    @if(session('flash_message'))
        <div class="flash-message">
            {{ session('flash_message') }}
        </div>
    @endif
    <p class="user-name">名前：{{ $login_user->name }}</p>
    <p class="user-mail">メールアドレス：{{ $login_user->email }}</p>
    <a href="/user/edit" class="button user-edit-button">変更</a>
@endsection