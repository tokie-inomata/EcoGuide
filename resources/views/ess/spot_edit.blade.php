@extends('layouts.main')

@section('main')
    <h2 class="title">スポット情報を変更します。</h2>
    <div class="spot-create-form">
        <form action="/" method="post">
            @csrf
            <label>登録スポット名
                <input type="text" name="spot_name"></label>
            <label>
                <p class="spot-add-address">住所</p>
                    <div class="spot-add-address-item">
                        <select>
                            @foreach(config('pref') as $k => $val)
                                @foreach($val as $k2 => $val2 )
                                    <option value="{{ $k2 }}">{{ $val2 }}</option>
                                @endforeach
                            @endforeach
                        </select><br>
                        <input type="text" name="spot_address" placeholder="○○市××区"><br>
                        <input type="text" name="spot_address"><br>
                    </div>
            </label>
            <p class="spot-add-item">品目</p>
                <div class="spot-add-item-list">
                    @foreach($recycling_item as $k => $val)
                        <input type="checkbox" value="{{ $k }}">{{ $val }}
                    @endforeach
                </div>
            <p class="spot-add-image">画像
                <div class="spot-add-image-form">
                    <input type="file" name="spot_area_image">
                </div>
            <input type="submit" name="spot_edit" class="button spot-edit-button" value="変更">
            <input type="submit" name="spot_delete" class="button spot-delete-button" value="削除">
        </form>
    </div>    
@endsection