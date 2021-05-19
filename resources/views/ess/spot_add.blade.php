@extends('layouts.main')

@section('main')
    <form action="/" method="post">
        @csrf
        <label>スポット名<input type="text" name="spot_name"></label>
        <label>
            <p class="spot_add_address">住所</p>
                <select>
                    @foreach(config('pref') as $k => $val)
                        @foreach($val as $k2 => $val2 )
                            <option value="{{ $k2 }}">{{ $val2 }}</option>
                        @endforeach
                    @endforeach
                </select><br>
                <input type="text" name="spot_address" placeholder="○○市××区"><br>
                <input type="text" name="spot_address"><br>
        </label>
        <p class="spot_add_item">品目</p>
            @foreach($item as $k => $val)
                <input type="checkbox" value="{{ $k }}">{{ $val }}
            @endforeach
        <p class="spot_add_image">画像
            <input type="file" name="spot_area_image">
        <input type="submit" name="spot_add" value="登録">
    </form>
@endsection