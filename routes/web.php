<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth')->group(function() {
    Route::resource('user', UserController::class)->only(['index']);
});

// 新ルート
Route::resource('/',  CommonController::class)                                   ->only('index');
Route::get('/login',  [LoginController::class, 'login'])                         ->name('user.login');
Route::post('/login', [LoginController::class, 'signin'])                        ->name('user.signin');
Route::get('/user/create',  [LoginController::class, 'create'])                        ->name('user.create');
Route::post('/user/create', [LoginController::class, 'store'])                         ->name('user.store');
Route::get('/logout', [LoginController::class, 'getLogout'])                     ->name('user.logout');


// 旧ルート
Route::get('/sitemap.xml',          'SitemapController@index');
/*             パスワード変更メール送信ルート              */
Route::get('/pass/edit/{token}',    'Auth\ResetPasswordController@showResetForm')      ->name('pass.edit');
Route::post('/pass/edit',           'Auth\ResetPasswordController@reset')              ->name('password.update');
Route::get('/pass/forget',          [LoginController::class ,'pass_forget'])           ->name('pass.forget');
Route::get('/pass/reset',           [LoginController::class ,'pass_reset'])            ->name('pass.reset');

/*             オートコンプリートルート                */
Route::get('spot/autocomplete',     'AutoCompleteController@autocomplete');

/*             ユーザー側ルート             */

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


// Auth::routes();

Route::get('/home', 'HomeController@index');
