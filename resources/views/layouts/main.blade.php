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
        <a href="/"><img alt="Ecoスポットサーチ" src="{{ asset('img/eco_spot_search.png') }}" class="titlelogo"></a>
        <nav>
            <ul>
                <ol><a href="/login">ログイン</a></ol>
                <ol><a href="/user_add">新規登録</a></ol>
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