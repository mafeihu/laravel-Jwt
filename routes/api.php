<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//用户登录
Route::get('/user/login','JwtController@login')->name('user.login');
//中间件
Route::middleware(['jwt_auth'])->group(function (){
    Route::get('user/info','JwtController@info')->name('user.info');
});