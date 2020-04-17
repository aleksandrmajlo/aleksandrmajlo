<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    $router->resource('/users', UserController::class);

    $router->resource('/firms', FirmController::class);

    $router->resource('reviews', ReviewController::class);

    $router->resource('photos', PhotoController::class);

    $router->get('banners', 'BannerController@index');
    $router->post('banners', 'BannerController@update');

});
