<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



/*             ユーザー側ルート             */


Route::get('/', 'MainController@index');
Route::get('/user_add', 'MainController@user_add');
Route::get('/login', 'MainController@login');
Route::get('/mypage', 'MainController@user_page');
Route::get('/registration_list', 'MainController@registration_list');
Route::get('/userdata_change', 'MainController@userdata_change');

/*             検索ルート             */

Route::get('/search', 'SearchController@search');
Route::get('/details_search', 'SearchController@details_search');

/*             管理者側ルート             */