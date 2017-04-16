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

//admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function () {
    // product
    Route::resource('product', 'ProductController');
    Route::group(['prefix' => 'product'], function () {
        Route::post('/sub-category', 'ProductController@getSubCategory');
    });
});

//member , 'middleware' => 'admin'
Route::group(['prefix' => 'member', 'namespace' => 'Member'], function () {
    // home
    Route::resource('/home', 'HomeController');
    Route::get('/get-login', 'HomeController@getFormLogin');
});

/*login user*/
Route::group(['namespace' => 'Auth'], function() {
    Route::get('/login', 'LoginController@index');
    Route::post('/login', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout');
    Route::post('/change-password', 'ResetPasswordController@changePassword');
    Route::get('/page-change-password', 'ResetPasswordController@index')->middleware('auth');
    // OAuth Routes
    Route::get('auth/{provider}', 'SocialiteController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'SocialiteController@handleProviderCallback');
});

Route::get('/home', 'HomeController@index');
