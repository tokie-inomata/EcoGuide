<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommonController;
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


Route::resource('/', CommonController::class)->only('index');
Route::get('/sitemap.xml',          'SitemapController@index');

/*             パスワード変更メール送信ルート              */
Route::get('/pass/edit/{token}',    'Auth\ResetPasswordController@showResetForm')      ->name('pass.edit');
Route::post('/pass/edit',           'Auth\ResetPasswordController@reset')              ->name('password.update');
Route::get('/pass/forget',          'MainController@pass_forget')                      ->name('pass.forget');
Route::get('/pass/reset',           'MainController@pass_reset')                       ->name('pass.reset');

/*             オートコンプリートルート                */
Route::get('spot/autocomplete',     'AutoCompleteController@autocomplete');

/*             ユーザー側ルート             */
Route::get('/mypage',      'UserController@mypage')    ->middleware('auth')->name('user.page');
Route::get('/user/create', 'UserController@create')                        ->name('user.add');
Route::post('user/create', 'UserController@add')                           ->name('user.create');
Route::get('/user/login',  'UserController@login')                         ->name('user_login');
Route::post('/user/login', 'UserController@signin')                        ->name('user_signin');
Route::get('/logout',      'UserController@getLogout')                     ->name('user_logout');
Route::get('/user/edit',   'UserController@edit')      ->middleware('auth')->name('user.edit');
Route::post('/user/edit',  'UserController@branch')    ->middleware('auth')->name('user.update');

/*             検索ルート             */

Route::get('/search',            'SearchController@search')->name('search');
Route::get('/citysearch',   'SearchController@city_search');

/*             Spotルート             */
Route::get('/spot/index',   'SpotController@index')  ->middleware('auth')  ->name('spot.index');
Route::get('/spot/create',  'SpotController@create') ->middleware('auth')  ->name('spot.add');
Route::post('/spot/create', 'SpotController@add')    ->middleware('auth')  ->name('spot.create');
Route::get('/spot/edit',    'SpotController@edit')   ->middleware('auth')  ->name('spot.edit');
Route::post('/spot/edit',   'SpotController@branch') ->middleware('auth')  ->name('spot.update');
Route::get('/spot/show',    'SpotController@show')                         ->name('spot.show');

/*             管理者側ルート             */
Route::get('/admin/user/index',   'AdminController@user_index')  ->middleware('auth') ->name('admin.user.index');
Route::get('/admin/spot/index',   'AdminController@spot_index')  ->middleware('auth') ->name('admin.spot.index');
Route::get('/admin/user/edit',    'AdminController@user_edit')   ->middleware('auth') ->name('admin.user.edit');
Route::get('/blacklist',          'AdminController@blacklist')   ->middleware('auth') ->name('blacklist');
Route::get('/admin/item/create',  'AdminController@item_create') ->middleware('auth') ->name('item.add');
Route::post('/admin/item/create', 'AdminController@item_add')    ->middleware('auth') ->name('item.create');


Auth::routes();

Route::get('/home', 'HomeController@index');
