@extends('layouts.user')

@section('main')
    @if(session('flash_message'))
        <div class="flash-message">
            {{ session('flash_message') }}
        </div>
    @endif
    <h2 class="title">全登録スポット一覧</h2>
    <form action="" method="get" class="search-box">
        <input type="text" name="admin_spot_search"><input type="submit" class="word-search" value="Search">
    </form>
    <div class="result-number">
        <form action="" method="get">
            <select type="text" class="number" name="paginate">
                @foreach(config('const')['paginate_number'] as $k => $val)
                    <option value="{{$val}}" {{$paginate == $val ? 'selected' : '' }}>{{$val}}件</option>
                @endforeach
            </select>
            <input type="submit" class="paginate-button" value="表示">
        </form>
    </div>
        @if (empty($spots))
            <p class="not-spot">登録されているスポットがありません。</p>
        @else
            <div class="result">
                @foreach ( $spots as $spot )
                    <a href="/spot/show?id={{ $spot->id }}">
                    <table class="spot-table search-result">
                        <tr>
                            <th rowspan="5">
                                @if(!empty($spot->image_path) && Storage::exists('/public/spot_image/'.$spot->image_path))
                                    <img src="{{ asset('storage/spot_image/' . $spot->image_path) }}">
                                @else
                                    <img src="{{ asset('img/EcoSpotSearch-logo.png') }}">
                                @endif
                            </th>
                        </tr>
                        <tr><td>名前   : {{ $spot->name }}</td></tr>
                        <tr><td>住所   : {{ $spot->getData() }}</td></tr>
                        <tr><td>品目   :
                            @foreach( $spot->recycling_items as $recycling_item )
                                {{ $recycling_item->recycling_item }}
                            @endforeach
                        </td></tr>
                        <tr><td>登録者 : {{ $spot->user->name }}</td></tr>
                    </table>
                    </a>
                @endforeach
                {{ $spots->appends($search_param)->links() }}
            </div>
        @endif
@endsection