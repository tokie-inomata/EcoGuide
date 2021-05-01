<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <div id="header">
        <img alt="Ecoスポットサーチ" href="/" class="titlelogo">
        <nav>
            <ul>
                <ol><a href="/">ログイン</a></ol>
                <ol><a href="/">新規登録</a></ol>
            </ul>
        </nav>
    </div>

    @yield('main')

    <div id="footer">
        <p class="copyright">Copyright ©︎ 2021 EcoGuide</p>
        <a class="inquiry" href="/">お問い合わせ</a>
    </div>
</body>
</html>