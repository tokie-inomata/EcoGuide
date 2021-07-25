<!doctype html>
<html>
<head>
    <title>Ecoスポットサーチ</title>
    <meta name="description" content="段ボールや雑誌、小型家電・蛍光灯・電池などを回収してくれる場所を探してみませんか？Ecoスポットサーチは資源の回収ボックスの場所を検索するサイトです。">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    @yield('js')

    <link rel="index" href="https://ecospotsearch.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Girassol&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho+B1:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('css/smartphone.css') }}" media="screen and (max-width: 480px)">
</head>
<body>
    <div class="footer-fixed">
        <div id="app"></div>

        <header>
        <a href="/" class="logo-title"><image src="{{ asset('img/EcoSpotSearch-logo.png') }}" height="75px"></a>
                <nav>
                    <ul class="main-menu">
                    @if(Auth::check())
                        <ol class="menu-button"><a href="/mypage">マイページ</a></ol>
                        <ol class="menu-button"><a href="{{ route('user_logout') }}">ログアウト</a></ol>
                    @else
                        <ol class="menu-button"><a href="/user/login">ログイン</a></ol>
                        <ol class="menu-button"><a href="/user/create">新規登録</a></ol>
                    @endif
                    </ul>
                </nav>
        </header>
        <div id="side-menu">
            <a href="/mypage" class="menu-list">ユーザー情報</a>
            <a href="/spot/index" class="menu-list">登録一覧</a>
            @if($login_user->admin_flg == 1)
                <a href="/admin/user/index" class="menu-list">全ユーザー一覧</a>
                <a href="/admin/spot/index" class="menu-list">全登録一覧</a>
                <a href="/admin/item/create" class="menu-list">品目一覧</a>
                <a href="/blacklist" class="menu-list">ブラックリスト</a>
            @endif
        </div>
        <div id="user-info">
            @yield('main')
        </div>
        <footer>
            <p class="copyright">Copyright ©︎ 2021 ESS</p>
        </footer>
    </div>
</body>
</html>