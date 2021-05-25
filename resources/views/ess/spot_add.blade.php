@extends('layouts.main')

@section('main')
    <h3>資源回収ボックスを登録します</h3>
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
                    @foreach($item as $k => $val)
                        <input type="checkbox" value="{{ $k }}">{{ $val }}
                    @endforeach
                </div>
            <p class="spot-add-image">画像
                <div class="spot-add-image-form">
                    <input type="file" name="spot_area_image">
                </div>
            <input type="submit" name="spot_add" class="spot-add-button button" value="登録">
        </form>
    </div>    
@endsection