@extends('layouts.user')

@section('main')
    <p class="user-name">名前：{{ $user->name }}</p>
    <p class="user-mail">メールアドレス：{{ $user->email }}</p>
    <a href="/user/edit" class="button user-edit-button">変更</a>
@endsection