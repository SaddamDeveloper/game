<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Api'], function () {
    // Game API
    Route::prefix('game')->group(function () {
        Route::get('play/three','GameController@gamePlayThree');
        Route::get('play/fifteen','GameController@gamePlayFifteen');
        Route::post('user/play','GameController@userPlayGame');
        Route::get('value','GameController@gameValue');
        // three Minute
        Route::get('result/{game_id}/{user_id}', 'GameController@gameResult');
        Route::get('full/three/result', 'GameController@gameFullThreeResult');
        // 15 Minutes
        Route::get('fifteen/result/{game_id}/{user_id}', 'GameController@gameResultFifteen');
        Route::get('full/fifteen/result', 'GameController@gameFullFifteenResult');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::post('login', 'UsersController@login');
        Route::post('otp','UsersController@sendOtp');
        Route::post('register', 'UsersController@userRegisteration');
        Route::get('order/amount/{order_id}', 'UsersController@paySuccess')->name('web.pay_order_amount');
        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::get('logout', 'UsersController@logout');
            Route::get('profile/{user_id}', 'UsersController@userProfile');
            Route::post('profile/update', 'UsersController@userProfileUpdate');
            Route::post('change/password', 'UsersController@userChangePassword');
            Route::get('details', 'UsersController@userDetails');
            // My Parity Record
            Route::get('my/record/{gameId}', 'UsersController@parityRecords');
            // set Nick Name
            Route::post('/nickname', 'UsersController@addNickName');
            // User Details
            Route::group(['prefix' => 'game'], function () {
                Route::get('play', 'GameController@gamePlay');
                Route::post('user/play', 'GameController@userPlayGame');
                Route::get('count/game_value', 'GameController@gameValue');
            });
            // Payment
            Route::post('recharge','UsersController@addRecharge');

            Route::get('transaction','UsersController@transaction');
            Route::get('withdrawal','UsersController@withdrawal');
            Route::post('withdrawal','UsersController@addWithdrawal');
            Route::get('address','UsersController@address');
            Route::post('address','UsersController@addAddress');
            Route::post('complaints','UsersController@addComplaints');
            Route::get('complaints','UsersController@complaints');
            Route::post('changepassword','UsersController@changePassword');
            // Bank Card
            Route::post('addbankcard','UsersController@addBankCard');
            Route::get('bankcards','UsersController@bankCards');
        });
    });
});
