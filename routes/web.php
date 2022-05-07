<?php

use Illuminate\Support\Facades\Route;
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
    Route::resource('user', UserController::class)->except(['create', 'store']);
    Route::resource('spot', SpotController::class);
});

// 新ルート
Route::resource('/',  CommonController::class)                                   ->only('index');
Route::get('/login',  [LoginController::class, 'login'])                         ->name('user.login');
Route::post('/login', [LoginController::class, 'signin'])                        ->name('user.signin');
Route::get('/signup',  [LoginController::class, 'create'])                        ->name('user.create');
Route::post('/signup', [LoginController::class, 'store'])                         ->name('user.signup');
Route::get('/logout', [LoginController::class, 'getLogout'])                     ->name('user.logout');
/*             パスワード変更メール送信ルート              */
Route::get('/pass/edit/{token}',    'Auth\ResetPasswordController@showResetForm')      ->name('pass.edit');
Route::post('/pass/edit',           'Auth\ResetPasswordController@reset')              ->name('password.update');
Route::get('/pass/forget',          [LoginController::class ,'pass_forget'])           ->name('pass.forget');
Route::get('/pass/reset',           [LoginController::class ,'pass_reset'])            ->name('pass.reset');


// 旧ルート
Route::get('/sitemap.xml',          'SitemapController@index');

/*             オートコンプリートルート                */
Route::get('/autocomplete',     'AutoCompleteController@autocomplete');

/*             検索ルート             */

Route::get('/search',            'SearchController@search')->name('search');
Route::get('/citysearch',   'SearchController@city_search');

/*             管理者側ルート             */
Route::get('/admin/user/index',   'AdminController@user_index')  ->middleware('auth') ->name('admin.user.index');
Route::get('/admin/spot/index',   'AdminController@spot_index')  ->middleware('auth') ->name('admin.spot.index');
Route::get('/admin/user/edit',    'AdminController@user_edit')   ->middleware('auth') ->name('admin.user.edit');
Route::get('/blacklist',          'AdminController@blacklist')   ->middleware('auth') ->name('blacklist');
Route::get('/admin/item/create',  'AdminController@item_create') ->middleware('auth') ->name('item.add');
Route::post('/admin/item/create', 'AdminController@item_add')    ->middleware('auth') ->name('item.create');


// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
