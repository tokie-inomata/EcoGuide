<!doctype html>
<html>
<head>
    <title>ESS</title>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Girassol&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho+B1:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css') }}">
</head>
<body>
    <div class="footer-fixed">
        <header>
            <a href="/" class="logo-title"><image src="{{ asset('img/EcoSpotSearch-logo.png') }}" height="100px"></a>
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

        @yield('main')

        <footer>
            <p class="copyright">Copyright ©︎ 2021 ESS</p>
        </footer>
    </div>
</body>
</html>