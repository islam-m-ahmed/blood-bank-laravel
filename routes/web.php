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

Route::get('/', function () {
    return view('welcome');
});
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

Auth::routes();

Route::prefix('dashboard')->middleware(['auth'])->namespace('Dashboard')->group(function (){
    //dashboard
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
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
});
