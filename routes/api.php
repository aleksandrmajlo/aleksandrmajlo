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
Route::post('images-get', 'UploadImagesController@getLink');


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
    Route::post('search', 'SearchController@index');



});
Route::group(['middleware' => 'auth:api','namespace' => 'API'], function () {
     Route::post('addFirm', 'FirmController@store');

     Route::post('addReview', 'ReviewController@addReview');
     Route::post('addPhotos', 'PhotoController@addPhotos');
});
