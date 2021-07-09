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


Route::get('/',                     'MainController@index');

/*             パスワード変更メール送信ルート              */
Route::get('/pass/edit/{token}',    'Auth\ResetPasswordController@showResetForm')      ->name('pass.edit');
Route::post('/pass/edit',           'Auth\ResetPasswordController@reset')              ->name('password.update');
Route::get('/pass/forget',          'MainController@pass_forget');
Route::get('/pass/reset',           'MainController@pass_reset');

/*             オートコンプリートルート                */
Route::get('spot/autocomplete',     'AutoCompleteController@autocomplete');

/*             ユーザー側ルート             */
Route::get('/mypage',      'UserController@mypage')    ->middleware('auth');
Route::get('/user/create', 'UserController@create');
Route::post('user/create', 'UserController@add');
Route::get('/user/login',  'UserController@login')     ->name('user_login');
Route::post('/user/login', 'UserController@signin')    ->name('user_signin');
Route::get('/logout',      'UserController@getLogout') ->name('user_logout');
Route::get('/user/edit',   'UserController@edit')      ->middleware('auth');
Route::post('/user/edit',  'UserController@branch')    ->middleware('auth')->name('user.update');

/*             検索ルート             */

Route::get('/search',              'SearchController@search');
Route::get('/citysearch',   'SearchController@city_search');

/*             Spotルート             */
Route::get('/spot/index',   'SpotController@index')  ->middleware('auth');
Route::get('/spot/create',  'SpotController@create') ->middleware('auth');
Route::post('/spot/create', 'SpotController@add')    ->middleware('auth')  ->name('spot.create');
Route::get('/spot/edit',    'SpotController@edit')   ->middleware('auth');
Route::post('/spot/edit',   'SpotController@branch') ->middleware('auth')  ->name('spot.update');
Route::get('/spot/show',    'SpotController@show');

/*             管理者側ルート             */
Route::get('/admin/user/index',   'AdminController@user_index')  ->middleware('auth');
Route::get('/admin/spot/index',   'AdminController@spot_index')  ->middleware('auth');
Route::get('/admin/user/edit',    'AdminController@user_edit')   ->middleware('auth');
Route::get('/blacklist',          'AdminController@blacklist')   ->middleware('auth');
Route::get('/admin/item/create',  'AdminController@item_create') ->middleware('auth');
Route::post('/admin/item/create', 'AdminController@item_add')    ->middleware('auth') ->name('item.create');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
