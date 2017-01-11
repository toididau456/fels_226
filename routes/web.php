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

Route::get('auth/{social}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{social}/callback', 'Auth\LoginController@handleProviderCallback');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('profile', 'ProfileController', ['only' => [
    'edit',
    'update',
    'index',
]]);

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/manager', function () {
        return view('layouts.admin');
    });
    Route::resource('cate', 'Admin\CategoryController', ['expert' => [
        'show',
    ]]);
});
