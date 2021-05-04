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
Route::get('/search', 'MainController@search');
Route::get('/user_add', 'MainController@user_add');
Route::get('/details_search', 'MainController@details_search');
Route::get('/login', 'MainController@login');




/*             管理者側ルート             */