@extends('layouts.main')

@section('main')
    @foreach( $spots as $spot )
        @if( $search_id == $spot->id)
            <div class="spot-show-contents">
                <div class="image-contents">
                    @if(!empty($spot->image_path))
                        <img src="{{ asset('storage/spot_image/' . $spot->image_path) }}" width="50%">
                    @else
                        <img src="{{ asset('img/EcoSpotSearch-logo.png') }}" width="30%">
                    @endif
                </div>
                <div class="spot-details-contents">
                    <p>スポット名：{{ $spot->name }}</p>
                    <p>住所:{{ $spot->getData() }}</p>
                    <p>品目:
                        @foreach( $spot->recycling_items as $recycling_item )
                            {{ $recycling_item->recycling_item }}
                        @endforeach
                    </p>
                    <a href="/spot/edit?id={{$spot->id}}">変更</a>
                </div>
            </div>
            <div class="google-map-contents">
            </div>
        @endif
    @endforeach
@endsection