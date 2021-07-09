@extends('layouts.main')

@section('js')
    <script src="{{ mix('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script type="module" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
@endsection

@section('main')
    <h2 class="title">スポット情報を変更します。</h2>
    <div class="spot-create-form">
        @foreach($spots as $spot)
            @if($spot->id == $search_id)
                <form action="{{ route('spot.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $spot->id }}">
                    <dl>
                        @if($errors->has('name'))
                            エラー:{{ $errors->first('name') }}
                        @endif
                        <dt>登録スポット名</dt>
                        <dd><input type="text" name="name" value="{{ $spot->name }}"></dd>
                        <input type="hidden" name="user_id" value="{{ $spot->user_id }}">
                        <dt>住所<br><br><br></dt>
                        @if($errors->has('city') || $errors->has('house_number') )
                            エラー:{{ $errors->first('city') }}
                            エラー:{{ $errors->first('house_number') }}
                        @endif
                        <dd>
                            <select name="prefecture" id="prefecture">
                                <option disabled value>選択してください</option>
                                @foreach(config('pref') as $k => $val)
                                    @foreach($val as $k2 => $val2 )
                                        <option value="{{ $k2 }}" id="{{ $k2 }}" {{$val2 == $spot->prefecture ? 'selected' : ''}}>{{ $val2 }}</option>
                                    @endforeach
                                @endforeach
                            </select><br>
                            <input type="text" name="city" placeholder="○○市××区" value="{{ $spot->city }}" id="city">
                            <datalist id="city-list">
                                <option value="test">
                                <option value="test1">
                            </datalist>
                            <br>
                            <input type="text" name="house_number" value="{{ $spot->house_number }}"><br>
                        </dd>
                        <dt>品目</dt>
                        <dd>
                            @foreach($recycling_item as $k)
                                @php
                                    $check_flg = false;
                                @endphp
                                @foreach($spot->recycling_items as $k2 => $val)
                                    @if($k->id == $val->id)
                                        @php
                                            $check_flg = true;
                                        @endphp
                                        <input type="checkbox" name="recycling_item_id[]" value="{{ $k->id }}" checked>{{ $k->recycling_item }}
                                    @endif
                                @endforeach
                                @if($check_flg == false)
                                    <input type="checkbox" name="recycling_item_id[]" value="{{ $k->id }}">{{ $k->recycling_item }}
                                @endif
                            @endforeach
                        </dd>
                        @if(!empty($city_list))
                        @endif
                        <dt>画像</dt>
                        @if($errors->has('image_path'))
                            エラー:{{ $errors->first('image_path') }}
                        @endif
                        <dd>
                            <input type="file" name="image_path">
                        </dd>
                    </dl>
                    <input type="submit" name="edit" class="submit-button button edit-button" value="変更">
                    <input type="submit" name="delete" class="submit-button button delete" value="削除">
                </form>
            @endif
        @endforeach
    </div>
@endsection