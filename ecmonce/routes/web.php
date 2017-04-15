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

Route::get('/', function () {
    return view('welcome');
});

//admin , 'middleware' => 'admin'
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    // ProductController
    Route::resource('/product', 'ProductController');
    Route::group(['prefix' => 'product'], function () {
        Route::post('/sub-category', 'ProductController@getSubCategory');
    });
});
