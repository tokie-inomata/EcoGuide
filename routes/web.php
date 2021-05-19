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

/*             ユーザー側ルート             */
Route::get('/user_add', 'UserController@user_add');
Route::get('/login', 'UserController@login');
Route::get('/user_edit', 'UserController@user_edit');

/*             検索ルート             */

Route::get('/search', 'SearchController@search');

/*             Spotルート             */
Route::get('/spot_add_list', 'SpotController@spot_add_list');
Route::get('/spot_add', 'SpotController@spot_add');
Route::get('/spot_edit', 'SpotController@spot_edit');

/*             管理者側ルート             */
Route::get('/user_list', 'AdminController@admin_user_list');
Route::get('/spot_list', 'AdminController@admin_spot_list');
Route::get('/admin_user_edit', 'AdminController@admin_user_edit');
Route::get('/blacklist', 'AdminController@blacklist');