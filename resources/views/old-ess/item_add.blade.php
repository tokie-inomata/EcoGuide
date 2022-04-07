@extends('layouts.user')

@section('main')
    <h2 class="title">品目一覧</h2>
    <table class="recycling-item-table">
        <tr>
            <th>ID</th>
            <th>品目</th>
            <th>変更</th>
        </tr>
        @foreach( $recycling_items as $recycling_item )
            <tr>
                <td>{{ $recycling_item->id }}</td>
                <td>{{ $recycling_item->recycling_item }}</td>
                <td>
                    <form action="" method="post" class="item-delete-form">
                        @csrf
                        <input type="hidden" name="id" value="{{$recycling_item->id}}">
                        <input type="submit" class="item-delete-button" name="delete" value="削除">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    @if($errors->has('recycling_item'))
        <p class="errors-message">{{$errors->first('recycling_item')}}</p>
    @endif
    <form action="" method="post" class="item-create-form">
        @csrf
        <input type="text" name="recycling_item"><input type="submit"  name="create" class="paginate-button" value="品目登録">
    </form>
@endsection