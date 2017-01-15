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

Route::group(['middleware' => 'auth'], function () {
    Route::resource('profile', 'ProfileController', ['except' => [
        'show',
        'index',
    ]]);
    Route::get('profile/{id?}', 'ProfileController@index');
    Route::resource('wordlist', 'WordListController', ['except' => [
        'show',
    ]]);
    Route::resource('wordlist', 'WordListController', ['only' => [
        'show',
        'index',
    ]]);
    Route::get('ajaxProfile/{id}/{type?}', 'ProfileController@ajaxProfileFollow');
    Route::get('ajaxFollow/{id}', 'ProfileController@ajaxFollow');
    Route::get('ajaxActivities/{id}', 'ProfileController@ajaxActivities');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/manager', function () {
        return view('layouts.admin');
    });
    Route::resource('cate', 'Admin\CategoryController', ['except' => [
        'show',
    ]]);
    Route::resource('user', 'Admin\UserController', ['except' => [
        'show',
    ]]);
    Route::resource('word', 'Admin\WordController', ['except' => [
        'show',
    ]]);
});
