@extends('layouts.main')

@section('main')
    @foreach( $spots as $spot )
        <div class="spot-show-contents">
            <div class="image-contents">
                @if(!empty($spot->image_path) && Storage::exists('/public/spot_image/'.$spot->image_path))
                    <img src="{{ asset('storage/spot_image/' . $spot->image_path) }}">
                @else
                    <img src="{{ asset('img/EcoSpotSearch-logo.png') }}">
                @endif
            </div>
            <div class="spot-details-contents">
                <td>スポット名：</td><dd>{{ $spot->name }}</dd>
                <td>住所：</td><dd>{{ $spot->getData() }}</dd>
                <td>品目：</td>
                <dd>
                    @foreach( $spot->recycling_items as $recycling_item )
                        {{ $recycling_item->recycling_item }}
                    @endforeach
                </dd>
                <td>備考欄：</td><dd>{!! nl2br($remarks) !!}</dd>
                @if(Auth::check())
                    @if(Auth::id() == $spot->user_id || Auth::user()->admin_flg == 1)
                        <a href="/spot/edit?id={{$spot->id}}" class="spot-edit-button">変更</a>
                    @endif
                @endif
            </div>
        </div>
    @endforeach
@endsection