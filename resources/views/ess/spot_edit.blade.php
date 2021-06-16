@extends('layouts.main')

@section('main')
    <h2 class="title">スポット情報を変更します。</h2>
    <div class="spot-create-form">
        @foreach( $spots as $spot )
            @if( $spot->id == $search_id )
                <form action="" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $spot->id }}">
                    <label>登録スポット名
                        <input type="text" name="name" value="{{ $spot->name }}"></label>
                    <label>
                    <input type="hidden" name="user_id" value="{{ $spot->user_id }}">
                        <p class="spot-add-address">住所</p>
                            <div class="spot-add-address-item">
                                <select name="prefecture">
                                    @foreach(config('pref') as $k => $val)
                                        @foreach($val as $k2 => $val2 )
                                            @if($val2 == $spot->prefecture)
                                                <option value="{{ $val2 }}" selected>{{ $val2 }}</option>
                                            @else
                                                <option value="{{ $val2 }}">{{ $val2 }}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select><br>
                                <input type="text" name="city" placeholder="○○市××区" value="{{ $spot->city }}"><br>
                                <input type="text" name="house_number" value="{{ $spot->house_number }}"><br>
                            </div>
                    </label>
                    <p class="spot-add-item">品目</p>
                        <div class="spot-add-item-list">
                            @foreach( $recycling_item as $k )
                                <input type="checkbox" name="recycling_item_id[]" value="{{ $k->id }}">{{ $k->recycling_item }}
                            @endforeach
                        </div>
                    <p class="spot-add-image">画像
                        <div class="spot-add-image-form">
                            <input type="file" name="spot_area_image">
                        </div>
                    <input type="submit" name="edit" class="button spot-edit-button" value="変更">
                    <input type="submit" name="delete" class="button spot-delete-button" value="削除">
                </form>
            @endif
        @endforeach
    </div>
@endsection