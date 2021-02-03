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
Auth::routes();

Route::get('/', 'ShopController@index')->name('main');

Route::get('/detail/{id}', 'ShopController@detail')->name('detail');

//ログインユーザーのみ
Route::group(['middleware' => 'auth'], function () {

    //カート内表示
    Route::get('/mycart', 'ShopController@myCart')->name('mycart');

    //カートに商品を追加
    Route::post('/mycart', 'ShopController@addMycart')->name('addcart');

    //カート内削除
    Route::post('/deletecart', 'ShopController@deleteCart')->name('deletecart');

    //購入画面
    Route::post('/checkout', 'ShopController@checkout');



    //アカウント情報
    Route::get('/acount', 'AcountController@acount')->name('acount');

    //お届け先登録ページ移動
    Route::get('/acount/add', function () {
        return view('acount.adress');
    })->name('adress');

    //お届け先登録
    Route::post('acount/create', 'AcountController@createAdress')->name('create.adress');

    //お届け先編集画面移動
    Route::get('acount/edit', 'AcountController@editAdress')->name('edit.adress');

    //お届け先変更画面
    Route::post('acount/edit', 'AcountController@updateAdress')->name('update.adress');

    //お客様情報
    // Route::get('acount/edit', 'AcountController@editAcount')->name('edit.acount');

    //アカウント情報変更
    Route::get('acount/reset_email', function () {
        return view('acount.reset_email');
    })->name('reset.email');

    // メールアドレス確認メールを送信
    Route::post('/email', 'AcountController@sendChangeEmailLink');

    // 新規メールアドレスに更新
    Route::get("reset/{token}", "AcountController@reset");
});


//管理者
Route::group(['prefix' => 'admin'], function () {

    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login');

    Route::get('register', 'Admin\Auth\RegisterController@showRegisterForm')->name('admin.register');
    Route::post('register', 'Admin\Auth\RegisterController@register')->name('admin.register');



    Route::get('/', 'Admin\HomeController@index')->name('admin.home');

    Route::middleware('auth:admin')->group(function () {

        Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

        //ログイン後ホーム画面
        Route::get('/', 'AdminController@admin')->name('admin.main');

        //商品の詳細
        Route::get('/detail/{id}', 'AdminController@detail')->name('admin.detail');

        //商品の削除
        Route::post('detail/delete', 'AdminController@delete')->name('admin.delete');

        //商品の編集
        Route::get('detail/edit/{id}', 'AdminController@edit')->name('admin.edit');

        //商品のアップロード
        Route::post('detail/edit/update', 'AdminController@update')->name('admin.update');

        //商品追加編集長
        Route::get('/add', 'AdminController@add')->name('admin.add');

        //追加確認
        Route::post('add/confirm', 'AdminController@confirm')->name('admin.confirm');

        //追加完了
        Route::post('add/create', 'AdminController@create')->name('admin.create');
    });
});
