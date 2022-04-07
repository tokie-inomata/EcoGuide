@extends('layouts.user')

@section('main')
    <h2 class="title">ブラックリスト</h2>
    <form action="" method="get" class="search-box">
        <input type="text" name="admin_blacklist_search"><input type="submit" class="word-search" value="Search">
    </form>
    <div class="result-number">
        <form action="" method="get">
            @if(!empty($admin_blacklist_search))
                <input type="hidden" name="admin_blacklist_search" value="$admin_blacklist_search">
            @endif
            <select type="text" class="number" name="paginate">
                @foreach(config('const')['paginate_number'] as $k => $val)
                    <option value="{{$val}}" {{$paginate == $val ? 'selected' : '' }}>{{$val}}件</option>
                @endforeach
            </select>
            <input type="submit" class="paginate-button" value="表示">
        </form>
    </div>
    <div class="user-list-reslut">
        <table class="user-list-table">
            <tr>
                <th class="user-list-id">ID</th>
                <th class="user-list-name">名前</th>
                <th class="user-list-mail">メールアドレス</th>
                <th class="user-list-edit">変更</th>
            </tr>
            @foreach($user as $k )
                @if($k->blacklist_flg == 1)
                    <tr>
                        <td class="user-list-id">{{ $k->id }}</td>
                        <td class="user-list-name">{{ $k->name }}</td>
                        <td class="user-list-mail">{{ $k->email }}</td>
                        <td class="user-list-edit"><a href="/admin/user/edit?id={{ $k->id }}" class="admin-user-edit">変更</a></td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
@endsection