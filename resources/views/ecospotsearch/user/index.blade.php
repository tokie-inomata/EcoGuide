@extends('adminlte::page')

@section('title', '管理画面 ユーザー情報')

@section('content')
    <div class="content">
        <h2 class="content-ttl">ユーザー情報</h2>
        <div class="left">
            <p class="ttl">ユーザー名</p>
            <p class="text">{{$user->name}}</p>
            <p class="ttl">ユーザー権限</p>
            <p class="text">{{$user->admin_flg->description}}</p>
        </div>
        <div class="right">
            <p class="ttl">メールアドレス</p>
            <p class="text">{{$user->email}}</p>
        </div>
    </div>
    <form action="{{ route('user.destroy', $user->id) }}" method="post" class="btn-form">
        @csrf
        @method('delete')
        <div class="btn-content">
            <a href="{{ route('user.edit', $user->id) }}" class="edit-btn btn">変更する</a>
            <button onclick="return confirm('本当に退会しますか？')" class="delete-btn btn">退会する</button>
        </div>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/common.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/admin.css')}}">
@stop

@section('js')
@stop
