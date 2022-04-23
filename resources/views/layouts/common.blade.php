<!doctype html>
<html>
<head>
    <title>Ecoスポットサーチ</title>
    <meta name="description" content="段ボールや雑誌、小型家電・蛍光灯・電池などを回収できる場所を探してみませんか？Ecoスポットサーチは資源の回収ボックスの場所を検索するサイトです。">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">

    @yield('css')
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Girassol&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho+B1:wght@500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
</head>
<body>
    <div class="footer-fixed">
        <header>
            <a href="/" class="logo-title">資源回収ボックス検索サイト<br><span>EcoSpotSearch</span></a>
            <div class="open">
                <span class="border"></span>
            </div>
            <nav>
                <ul class="main-menu sp-menu">
                    @if(Request::is('/'))
                        <ol class="menu-button"><a href="#search">検索</a></ol>
                    @else
                        <ol class="menu-button"><a href="/">HOME</a></ol>
                    @endif
                    @if(Auth::check())
                        <ol class="menu-button"><a href="{{ route('user.index') }}">マイページ</a></ol>
                        <ol class="menu-button"><a href="{{ route('user.logout') }}">ログアウト</a></ol>
                    @else
                        <ol class="menu-button"><a href="{{ route('user.login') }}">ログイン</a></ol>
                        <ol class="menu-button"><a href="{{ route('user.create') }}">登録</a></ol>
                    @endif
                </ul>
            </nav>
        </header>

        @yield('contents')

        <footer>
            <p class="copyright">Copyright ©︎ 2021 EcoSpotSearch</p>
        </footer>
    </div>
    @yield('js')
</body>
</html>