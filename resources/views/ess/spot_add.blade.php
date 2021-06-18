@extends('layouts.main')

@section('main')
    <h2 class="title">資源回収ボックスを登録します</h2>
    <div class="spot-create-form">
        <form action="{{ route('spot.create') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label>登録スポット名
            @if($errors->has('name'))
                エラー:{{ $errors->first('name') }}
            @endif
            <input type="text" name="name"></label>
            <label>
                <p class="spot-add-address">住所</p>
                @if($errors->has('prefecture'))
                    エラー:{{ $errors->first('prefecture') }}
                @endif
                @if($errors->has('city'))
                    エラー:{{ $errors->first('city') }}
                @endif
                @if($errors->has('house_number'))
                    エラー:{{ $errors->first('house_number') }}
                @endif
                    <div class="spot-add-address-item">
                        <select name="prefecture">
                            @foreach(config('pref') as $k => $val)
                                @foreach($val as $k2 => $val2 )
                                    <option value="{{ $val2 }}">{{ $val2 }}</option>
                                @endforeach
                            @endforeach
                        </select><br>
                        <input type="text" name="city" placeholder="○○市××区"><br>
                        <input type="text" name="house_number"><br>
                    </div>
            </label>
            <p class="spot-add-item">品目</p>
            @if($errors->has('recycling_item'))
                エラー:{{ $errors->first('recycling_item') }}
            @endif
                <div class="spot-add-item-list">
                    @foreach( $recycling_item as $k )
                        <input type="checkbox" name="recycling_item_id[]" value="{{ $k->id }}">{{ $k->recycling_item }}
                    @endforeach
                </div>
            <p class="spot-add-image">画像</p>
            @if($errors->has('image_path'))
                エラー:{{ $errors->first('image_path') }}
            @endif
                <div class="spot-add-image-form">
                    <input type="file" name="image_path">
                </div>
            <input type="hidden" name="users_id" value="{{$users_id}}">
            <input type="submit" name="spot_add" class="spot-add-button button" value="登録">
        </form>
    </div>    
@endsection