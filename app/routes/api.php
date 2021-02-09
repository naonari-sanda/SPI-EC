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

Route::post('/logout', 'LoginController@logout');
//商品一覧画面
Route::get('/', 'ShopController@index');
//商品詳細画面
Route::get('/detail/{id}', 'ShopController@detail');
//カートに商品を追加
Route::post('/mycart', 'ShopController@addMycart');
//カート内表示
Route::get('/mycart/{id}', 'ShopController@myCart');
//カート内削除
Route::post('/deletecart', 'ShopController@deleteCart');
