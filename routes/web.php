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

//Route::get('/help', function () {
//    return view('help-info');
//});

Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth' => 'verified']], function () {
    Route::resource('give', 'GiveController');
    Route::resource('need', 'NeedController');
    Route::resource('hope', 'HopeController');
    Route::resource('search', 'SearchController');
    Route::resource('chat', 'ChatController');
    Route::resource('user', 'UserController');
    Route::group(['prefix' => 'person'], function () {
        Route::get('health_status', 'UserController@healthStatus');
        Route::get('picture', 'UserController@pictureUpdate');
    });
    Route::get('post_info/{post_id}', 'SearchController@postInformation');
    Route::get('post_like/{post_id}', 'SearchController@postLike');
    Route::get('post_dislike/{post_id}', 'SearchController@postDislike');
});
Route::group(['middleware' => ['auth' => 'verified','checkUserRole']], function () {
    Route::resource('admin', 'AdminController');
});
