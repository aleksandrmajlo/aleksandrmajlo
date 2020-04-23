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

Route::post('images-save', 'UploadImagesController@store');
Route::post('images-delete', 'UploadImagesController@destroy');

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');
    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('users', 'UserController@index');
    Route::get('users/{id}', 'UserController@show');
});
Route::group(['namespace' => 'API'], function () {
    Route::get('getFirms', 'FirmController@index');
    Route::post('getFirm', 'FirmController@getFirm');
    Route::post('getReview', 'ReviewController@getReview');
    // поиск
    Route::get('search', 'SearchController@index');
    // сохранение времени работы
    Route::post('saveTimeWork', 'FirmController@saveTimeWork');
    //пользователь
    Route::post('my_review', 'UserController@my_review');
    Route::post('my_firms', 'UserController@my_firms');
    Route::post('my_favorite', 'UserController@my_favorite');
    // form
    Route::post('send', 'FormController@send');
});
Route::group(['middleware' => 'auth:api','namespace' => 'API'], function () {
     Route::post('addFirm', 'FirmController@store');
     Route::post('addReview', 'ReviewController@addReview');
     Route::post('addPhotos', 'PhotoController@addPhotos');
});
