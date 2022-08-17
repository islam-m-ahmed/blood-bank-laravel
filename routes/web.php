<?php

use Illuminate\Support\Facades\Route;

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
//
//Route::get('api-test', function (){
//    $posts = \App\Models\Post::all();
//    $response = [
//        'status' => 1,
//        'message' => 'sucecss',
//        'data' => $posts
//    ];
//    return $response;
//});
Route::group(['namespace' => 'front','middleware'=>'auth:client-web'],function(){
    //home page
    Route::get('/','HomeController@index');
    Route::get('/about_us','HomeController@aboutUs');
    Route::get('/article/{id}','HomeController@article')->name('article');
    //details of one donation request
    Route::get('donation_request/{id}','HomeController@donationRequest')->name('donation_request');
    Route::get('donation_requests','HomeController@donationRequests')->name('donation_requests');
    //toggle
    Route::post('toggle_favourite','HomeController@toggleFavourite')->name('toggleFavourite');

});

Auth::routes();

//dashboard admin
Route::prefix('dashboard')->middleware(['auth','check-permission'])->namespace('Dashboard')->group(function (){
    //dashboard
    Route::get('/',[App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //governorate
    Route::resource('governorate','GovernorateController');
    //cities
    Route::resource('city','CityController');
    //category
    Route::resource('category','CategoryController');
    //posts
    Route::resource('post','PostController');
    //clients
    Route::get('client','ClientController@index')->name('client.index');
    Route::get('client/show/{id}','ClientController@show')->name('client.show');
    Route::delete('client/{id}','ClientController@destroy')->name('client.destroy');
    Route::get('status/{id}/{status}','ClientController@status')->name('client.status');
    //contacts
    Route::resource('contact','ContactController');
    //settings
    Route::get('setting/edit','SettingController@edit')->name('setting.edit');
    Route::put('setting/update','SettingController@update')->name('setting.update');
    //donation request controller
    Route::resource('donation_request','DonationRequestController');
    // roles
    Route::resource('role','RoleController');
    //users
    Route::resource('user','UserController');
});
