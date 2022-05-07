@extends('adminlte::page')

@section('title', '管理画面 スポット一覧')

@section('content')
    <div class="content-top">
        <h2 class="content-ttl">登録スポット一覧</h2>
        <a href="{{route('spot.create')}}" class="btn">スポット登録</a>
    </div>
    @if($spotsCount == 0)
    <p>
        登録しているスポットはありません。<br>
        よければ登録にご協力よろしくお願いいたします。
    </p>
    @else
        <table id="spot-index" class="table">
            <thead>
                <tr>
                    <th>画像</th>
                    <th>スポット名</th>
                    <th>住所</th>
                    <th>アイテム</th>
                    <th>登録日時</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($spots as $spot)
                    <tr>
                        <td>
                            @if(!empty($spot->image_path) && Storage::exists('/public/spot_image/'.$spot->image_path))
                                <img src="{{ asset('storage/spot_image/' . $spot->image_path) }}">
                            @else
                                <img src="{{ asset('img/EcoSpotSearch-logo.png') }}">
                            @endif
                        </td>
                        <td>{{$spot->name}}</td>
                        <td>{{$spot->getData()}}</td>
                        <td>
                            @foreach($spot->recycling_items as $item)
                                {{$item->recycling_item}}
                            @endforeach
                        </td>
                        <td>{{$spot->created_at->format('Y/m/d H:i')}}</td>
                        <td><a href="{{route('spot.show', $spot->id)}}">詳細</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/common.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/admin.css')}}">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(
            function() {
                $('#spot-index').DataTable({
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Japanese.json"
                    },
                    order: [
                        ['4', 'decs'],
                    ],
                });
            });
    </script>
@stop
