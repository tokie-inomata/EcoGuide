@extends('layouts.main')

@section('main')
<form action="/details_search" method="get">
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