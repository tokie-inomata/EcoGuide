@extends('layouts.main')

@section('main')
    <div class="image-contentes">
        <img src="/">
    </div>
    <div class="spot-details-contents">
        @foreach( $spots as $spot )
            @if( $search_id == $spot->id)
                <p>スポット名：{{ $spot->name }}</p>
                <p>住所:{{ $spot->getData() }}</p>
                <p>品目:
                    @foreach( $spot->recycling_items as $recycling_item )
                        {{ $recycling_item->recycling_item }}
                    @endforeach
                </p>
                <a href="/spot/edit?id={{$spot->id}}">変更</a>
            @endif
        @endforeach
    </div>
    <div class="google-map-contents">
    </div>
@endsection