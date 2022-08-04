<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->namespace('Api')->group(function (){
    Route::get('governorate','MainController@governorate');
    Route::get('cities','MainController@cities');
    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');
    Route::get('categories','MainController@categories');
    Route::get('bloodTypes','MainController@bloodTypes');
    Route::get('settings','MainController@settings');
    // password
    Route::post('resetPassword', 'AuthController@resetPassword');
    Route::post('newPassword', 'AuthController@newPassword');

    // use middleware
    Route::group(['middleware'=>'auth:api'],function (){
        Route::post('profile','AuthController@profile');
        Route::post('contacts','MainController@contacts');
        //notifications
        Route::get('notifications','MainController@notifications');
        Route::post('notificationSettings','mainController@notificationSettings');
        Route::get('getNotificationSettings','MainController@getNotificationSettings');
        //post
        Route::get('posts','MainController@posts');
        Route::get('post','MainController@post');
        // favourites
        Route::post('favourite','MainController@favourite');
        Route::get('myFavourites','MainController@myFavourites');
        //token
        Route::post('registerToken','AuthController@registerToken');
        Route::post('removeToken','AuthController@removeToken');
        // donation requests
        Route::post('createDonationRequest','MainController@createDonationRequest');


    });
});


