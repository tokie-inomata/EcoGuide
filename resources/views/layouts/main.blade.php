<html>
<head>
    <title>ESS</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Shippori+Mincho+B1:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user_add.css') }}">
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
        <p class="copyright">Copyright ©︎ 2021 ESS</p>
        <a class="inquiry" href="/">お問い合わせ</a>
    </div>
</body>
</html>