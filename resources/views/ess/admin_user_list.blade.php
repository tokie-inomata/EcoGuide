@extends('layouts.user')

@section('main')
    <h2 class="title">全ユーザー一覧</h2>
    <form action="" method="get" class="search-box">
        <input type="text" name="admin_user_search"><input type="submit" class="word-search" value="Search">
    </form>
    <div class="result-number">
        <form action="" method="get">
            <select type="text" class="number" name="paginate">
                @foreach(config('const') as $k => $val)
                    @if($k == 'paginate_number')
                        @foreach($val as $k2 => $val2)
                            <option value="{{$val2}}" {{$paginate == $val2 ? 'selected' : '' }}>{{$val2}}件</option>
                        @endforeach
                    @endif
                @endforeach
            </select>
            <input type="submit" class="paginate-button" value="表示">
        </form>
    </div>
    <div class="user-list-reslut">
        <table class="user-list-table">
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>変更</th>
            </tr>
            @foreach($user as $k )
                @if($k->blacklist_flg == 1)
                    <tr class="blasklist-user">
                        <td>{{ $k->id }}</td>
                        <td>{{ $k->name }}</td>
                        <td>{{ $k->email }}</td>
                        <td><a href="/admin/user/edit?id={{ $k->id }}" class="admin-user-edit">変更</a></td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $k->id }}</td>
                        <td>{{ $k->name }}</td>
                        <td>{{ $k->email }}</td>
                        <td><a href="/admin/user/edit?id={{ $k->id }}" class="admin-user-edit">変更</a></td>
                    </tr>
                @endif
            @endforeach
        </table>
        {{ $user->appends($search_param)->links() }}
    </div>
@endsection