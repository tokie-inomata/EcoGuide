@extends('layouts.main')

@section('main')
    @foreach( $spots as $spot )
        <div class="spot-show-contents">
            <div class="image-contents">
                @if(!empty($spot->image_path) && Storage::exists('/public/spot_image/'.$spot->image_path))
                    <img src="{{ asset('storage/spot_image/' . $spot->image_path) }}" width="50%">
                @else
                    <img src="{{ asset('img/EcoSpotSearch-logo.png') }}" width="30%">
                @endif
            </div>
            <div class="spot-details-contents">
                <p>スポット名：{{ $spot->name }}</p>
                <p>住所：{{ $spot->getData() }}</p>
                <p>品目：
                    @foreach( $spot->recycling_items as $recycling_item )
                        {{ $recycling_item->recycling_item }}
                    @endforeach
                </p>
                <p>備考欄：{{ $spot->etc }}</p>
                @if(Auth::check())
                    @if(Auth::id() == $spot->user_id || Auth::user()->admin_flg == 1)
                        <a href="/spot/edit?id={{$spot->id}}" class="spot-edit-button">変更</a>
                    @endif
                @endif
            </div>
        </div>
        <div class="google-map-contents">
        </div>
    @endforeach
@endsection