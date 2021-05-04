@extends('layouts.main')

@section('main')
<form action="/search" method="get">
    <table class="search_area">
        @csrf
        <tr><th>都道府県</th>
        <td>
            <select type="text" class="search_control" name="area">
                @foreach(config('pref') as $key => $score)
                    <option value="{{ $score }}">{{ $score }}</option>
                @endforeach
            </select>
        </td>
        </tr>
        <tr>
            <th rowspan="4">市区町村</th>
            <td>
                <input type="radio" name="municipality" value="テスト1">テスト1
            </td>
            <td>
                <input type="radio" name="municipality" value="テスト2">テスト2
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="municipality" value="テスト3">テスト3
            </td>
            <td>
                <input type="radio" name="municipality" value="テスト4">テスト4
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="municipality" value="テスト5">テスト5
            </td>
            <td>
                <input type="radio" name="municipality" value="テスト6">テスト6
            </td>
        </tr>
        <tr>
            <td>
                <input type="radio" name="municipality" value="テスト7">テスト7
            </td>
        </tr>
        <tr>
            <th rowspan="4">品目</th>
            <td>
                <input type="checkbox" name="item" value="段ボール">段ボール
            </td>
            <td>
                <input type="checkbox" name="item" value="紙・雑誌">紙・雑誌
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="item" value="衣類">衣類
            </td>
            <td>
                <input type="checkbox" name="item" value="小型金属">小型金属            
            </td>
        </tr>
        <tr>
            <td>
                <input type="checkbox" name="item" value="小型家電">小型家電
            </td>
            <td>
                <input type="checkbox" name="item" value="その他">その他            
            </td>
        </tr>
    </table>
    <input type="submit" value="詳細検索" class="search_button">
</form>

<h2 class="result">検索結果</h2>
<div class="display_number">
    <p>表示</p>
    <select type="text" class="number">
        <option>10件</option>
        <option>30件</option>
        <option>50件</option>
    </select>
</div>
<table class="search_result">
    <tr><th rowspan="6"><img src="/"></th><td></td></tr>
    <tr><td>名前 :</td></tr>
    <tr><td>住所 :</td></tr>
    <tr><td>品目 :</td></tr>
    <tr><td></td></tr>
</table>
@endsection