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


Route::get('/', 'MainController@index');
Route::get('/mypage', 'MainController@user_page');
Route::get('/pass_edit', 'MainController@pass_edit');
Route::get('/pass_forget', 'MainController@pass_forget');
Route::get('/pass_reset', 'MainController@pass_reset');

/*             ユーザー側ルート             */
Route::get('/user/create', 'UserController@create');
Route::get('/login', 'UserController@login');
Route::get('/user/edit', 'UserController@edit');

/*             検索ルート             */

Route::get('/search', 'SearchController@search');

/*             Spotルート             */
Route::get('/spot/index', 'SpotController@index');
Route::get('/spot/create', 'SpotController@create');
Route::get('/spot/edit', 'SpotController@edit');

/*             管理者側ルート             */
Route::get('/admin/user/index', 'AdminController@user_index');
Route::get('/admin/spot/index', 'AdminController@spot_index');
Route::get('/admin/user/edit', 'AdminController@user_edit');
Route::get('/blacklist', 'AdminController@blacklist');