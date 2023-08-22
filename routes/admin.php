<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin'], function () {
    Route::get('/admin/login', 'LoginController@index')->name('admin.login_form');
    Route::post('admin/login', 'LoginController@adminLogin')->name('admin.login');

    Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin'], function () {
        Route::get('/dashboard', 'DashboardController@dashboardView')->name('admin.deshboard');
        Route::post('logout', 'LoginController@logout')->name('admin.logout');
        
        Route::group(['prefix'=>'user'],function(){
            Route::get('list', 'UserController@userList')->name('admin.user_list'); 
            Route::get('list/ajax','UserController@userListAjax')->name('admin.user_list_ajax');
            // GamePlay
            Route::group(['prefix' => 'gameplay'], function () {
                Route::get('/', 'UserController@gameplay')->name('admin.user_game_play');
                Route::get('/edit/{user}', 'UserController@edit')->name('admin.user.edit');
                Route::put('update/{user}', 'UserController@update')->name('admin.user.update');
                Route::get('/status/{user}', 'UserController@status')->name('admin.user.status');
                Route::get('/list', 'UserController@gameplayList')->name('admin.gameplay_list_ajax');
            });
            // User Orders
            Route::group(['prefix' => 'orders'], function () {
                Route::get('/', 'UserController@order')->name('admin.order');
                Route::get('/list', 'UserController@orderList')->name('admin.user_order_ajax');
            });
            // Payment Requests
            Route::group(['prefix' => 'payment'], function () {
                Route::get('/request', 'UserController@request')->name('admin.payment.request');
                Route::get('request/list', 'UserController@requestList')->name('admin.payment.request.ajax');
                Route::post('request/update/', 'UserController@requestUpdate')->name('admin.ajax.request.update');
                Route::get('user/info/{id}', 'UserController@userInfo')->name('admin.users.account_info');
            });
            // Complaint & Suggestions
            Route::group(['prefix' => 'complaint'], function () {
                Route::get('/', 'UserController@complaint')->name('admin.complaint');
                Route::get('/data', 'UserController@getComplaint')->name('admin.ajax.complaint');
            });
        });
        Route::group(['prefix' => 'wallet', 'namespace' => 'Wallet'], function () {
            Route::get('wallet/list', 'WalletController@index')->name('admin.user_wallet');
            Route::get('data/wallet', 'WalletController@walletList')->name('admin.wallet_list_ajax');
            Route::get('data/wallet/history/{id}', 'WalletController@walletHistory')->name('admin.wallet_history');
        });
        Route::group(['prefix' => 'game', 'namespace'=> 'Game'], function(){
            Route::get('/', 'GameResultController@index')->name('admin.game');
            Route::get('/get/game', 'GameResultController@game')->name('admin.get_game');

            Route::get('get/win/amount/{type}/{data}','GameResultController@gameWinAmountFetch');
            Route::post('result/insert','GameResultController@resultInsert')->name('admin.result_insert');
        });
        // Route::group(['prefix' => 'user'], function () {
        //     Route::get('list', 'UserController@userList')->name('admin.user_list');
        //     Route::get('list/ajax', 'UserController@userListAjax')->name('admin.user_list_ajax');
        // });
    });
});
