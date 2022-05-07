@extends('adminlte::page')

@section('title', '管理画面 スポット登録')

@section('content')
    <h2 class="content-ttl">スポット登録</h2>
    <div class="add-form">
        <form action="{{route('spot.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-content">
                <p class="form-ttl">スポット名</p><span class="red">必須</span>
                <input type="text" name="name">
            </div>
            <div class="form-content">
                <p class="form-ttl">住所</p><span class="red">必須</span>
                <div class="address-content">
                    <select id="prefecture" name="prefecture">
                        @foreach(config('pref') as $area)
                            <option value="{{$area['pref_num']}}">{{$area['pref']}}</option>
                        @endforeach
                    </select><br>
                    <input type="text" name="city" placeholder="○○市××区" id="city"><br>
                    <input type="text" name="house_number"><br>
                </div>
            </div>
            <div class="form-content">
                <p class="form-ttl">品目</p><span class="red">必須</span>
                <div class="form-checkbox">
                    @foreach( $recyclingItems as $recyclingItem )
                        <label><input type="checkbox" name="recycling_item_id[]" value="{{ $recyclingItem->id }}">{{ $recyclingItem->recycling_item }}</label>
                    @endforeach
                </div>
            </div>
            <div class="form-content">
                <p class="form-ttl">備考欄</p>
                <textarea name="etc"></textarea>
            </div>
            <div class="form-content">
                <p class="form-ttl">画像</p>
                <div class="img-content">
                    <div class="left">
                        <img id="preview">
                    </div>
                    <div class="right">
                        <input type="file" name="image_path" id="preview-img">
                    </div>
                </div>
            </div>
            <div class="btn">
                <input type="submit" value="登録する">
            </div>
        </form>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/common.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/admin.css')}}">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="module" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('/js/jquery.js')}}" defer></script>
@stop
