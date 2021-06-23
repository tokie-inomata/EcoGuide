@extends('layouts.main')

@section('main')
    <h2 class="title">スポット情報を変更します。</h2>
    <div class="spot-create-form">
        @foreach( $spots as $spot )
            @if( $spot->id == $search_id )
                <form action="" method="post"  enctype="multipart/form-data">
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
                        @if($errors->has('city'))
                            エラー:{{ $errors->first('city') }}
                        @endif
                        @if($errors->has('house_number'))
                            エラー:{{ $errors->first('house_number') }}
                        @endif
                        <dd>
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
                        </dd>
                        <dt>品目</dt>
                        <dd>
                            @foreach( $recycling_item as $k )
                                <input type="checkbox" name="recycling_item_id[]" value="{{ $k->id }}">{{ $k->recycling_item }}
                            @endforeach
                        </dd>
                        <dt>画像</dt>
                        @if($errors->has('image_path'))
                            エラー:{{ $errors->first('image_path') }}
                        @endif
                        <dd>
                            <input type="file" name="image_path">
                        </dd>
                    </dl>
                    <input type="submit" name="edit" class="submit-button button" value="変更">
                    <input type="submit" name="delete" class="submit-button button" value="削除">
                </form>
            @endif
        @endforeach
    </div>
@endsection