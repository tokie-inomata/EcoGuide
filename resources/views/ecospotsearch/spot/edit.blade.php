@extends('adminlte::page')

@section('title', '管理画面 スポット編集')

@section('content')
    <h2 class="content-ttl">スポット編集</h2>
    <div class="add-form">
        <form action="{{route('spot.update', $spot->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="form-content">
                <p class="form-ttl">スポット名</p><span class="red">必須</span>
                <input type="text" name="name" value="{{$spot->name}}">
            </div>
            <div class="form-content">
                <p class="form-ttl">住所</p><span class="red">必須</span>
                <div class="address-content">
                    <select id="prefecture" name="prefecture">
                        @foreach(config('pref') as $area)
                            <option value="{{$area['pref_num']}}" {{$area['pref'] == $spot->prefecture ? 'selected' : ''}}>{{$area['pref']}}</option>
                        @endforeach
                    </select><br>
                    <input type="text" name="city" placeholder="○○市××区" id="city" value="{{$spot->city}}"><br>
                    <input type="text" name="house_number" value="{{$spot->house_number}}"><br>
                </div>
            </div>
            <div class="form-content">
                <p class="form-ttl">品目</p><span class="red">必須</span>
                <div class="form-checkbox">
                    @foreach($selectItems as $selectItem)
                        <label><input type="checkbox" name="recycling_item_id[]" value="{{$selectItem->id}}" checked>{{$selectItem->recycling_item}}</label>
                    @endforeach
                    @foreach($otherItems as $otherItem)
                        <label><input type="checkbox" name="recycling_item_id[]" value="{{$otherItem->id}}">{{$otherItem->recycling_item}}</label>
                    @endforeach
                </div>
            </div>
            <div class="form-content">
                <p class="form-ttl">備考欄</p>
                <textarea name="etc">{{$spot->etc}}</textarea>
            </div>
            <div class="form-content">
                <p class="form-ttl">画像</p>
                <div class="img-content">
                    <div class="left">
                        @if(!empty($spot->image_path) && Storage::exists('/public/spot_image/'.$spot->image_path))
                            <img src="{{asset('storage/spot_image/' . $spot->image_path)}}" id="preview">
                        @else
                            <img src="{{asset('img/EcoSpotSearch-logo.png')}}" id="preview">
                        @endif
                    </div>
                    <div class="right">
                        <input type="file" name="image_path" id="preview-img">
                    </div>
                </div>
            </div>
            <div class="btn">
                <input type="submit" value="変更する">
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
