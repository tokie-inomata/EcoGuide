@extends('adminlte::page')

@section('title', '管理画面 スポット詳細')

@section('content')
    <div class="content spot-content">
        <h2 class="content-ttl">スポット詳細</h2>
        <div class="left">
            <div class="img-content">
                @if(isset($spot->image_path) && Storage::exists('/public/spot_image/'.$spot->image_path))
                    <img src="{{ asset('storage/spot_image/' . $spot->image_path) }}">
                @else
                    <img src="{{ asset('img/EcoSpotSearch-logo.png') }}">
                @endif
            </div>
        </div>
        <div class="right">
            <div class="detail">
                <p>スポット名</p><span>{{$spot->name}}</span>
            </div>
            <div class="detail">
                <p>住所</p><span>{{$spot->getData()}}</span>
            </div>
            <div class="detail">
                <p>品目</p>
                <span>
                    @foreach($spot->recycling_items as $item)
                        {{$item->recycling_item}}
                    @endforeach
                </span>
            </div>
            <div class="detail">
                <p>備考</p><span>{{$spot->etc}}</span>
            </div>
        </div>
    </div>
    <form action="{{ route('spot.destroy', $spot->id) }}" method="post" class="btn-form">
        @csrf
        @method('delete')
        <div class="btn-content">
            <a href="{{ route('spot.edit', $spot->id) }}" class="edit-btn btn">変更する</a>
            <button onclick="return confirm('本当に削除しますか？')" class="delete-btn btn">削除する</button>
        </div>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/common.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/admin.css')}}">
@stop

@section('js')
@stop
