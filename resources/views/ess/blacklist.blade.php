@extends('layouts.user')

@section('main')
    <h2 class="title">ブラックリスト</h2>
    <form action="" method="get" class="search-box">
        <input type="text" size="50" name="admin_blacklist_search"><input type="submit" value="検索">
    </form>
    <div class="result-number">
        <form action="" method="get">
            @if(!empty($admin_blacklist_search))
                <input type="hidden" name="admin_blacklist_search" value="$admin_blacklist_search">
            @endif
            <select type="text" class="number" name="paginate">
                @if($paginate == 10)
                    <option value="10" selected>10件</option>
                @else
                    <option value="10">10件</option>
                @endif
                @if($paginate == 30)
                    <option value="30" selected>30件</option>
                @else
                    <option value="30">30件</option>
                @endif
                @if($paginate == 50)
                    <option value="50" selected>50件</option>
                @else
                    <option value="50">50件</option>
                @endif
            </select>
            <input type="submit" value="表示">
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
                <tr>
                    <td class="user-list-id">{{ $k->id }}</td>
                    <td class="user-list-name">{{ $k->name }}</td>
                    <td class="user-list-mail">{{ $k->email }}</td>
                    <td class="user-list-edit"><a href="/admin/user/edit?id={{ $k->id }}" class="admin-user-edit">変更</a></td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection