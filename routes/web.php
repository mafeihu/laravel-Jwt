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
//分组简化命名空间
Route::group(['namespace'=>'Admin'],function (){
    Route::get('admin/jwt/index','JwtController@index')->name('jwt.index');
});

////用户登录
//Route::get('login','JwtController@login')->name('user.login');
////中间件
//Route::middleware(['jwt_auth'])->group(function (){
//    Route::get('info','JwtController@info')->name('user.info');
//});




