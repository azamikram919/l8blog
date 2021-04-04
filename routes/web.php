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

Route::group(['middleware' => 'language'], function () {
    Route::view('/', 'welcome');

    //Route::get('users', 'UserController@index')->name('users');
    //Route::get('users/{id}', 'UserController@show');
    Route::get('posts/create', 'PostController@create');
    Route::get('/posts', 'PostController@index');
    Route::post('/posts', 'PostController@store');
    Route::get('/posts/show/{post}', 'PostController@show');
    Route::get('/posts/{id}/edit', 'PostController@edit');
    Route::post('/posts/update', 'PostController@update');
    Route::get('/posts/{id}/delete', 'PostController@delete');
    Route::get('language/{lang}', function ($lang) {
        \Session::put('locale', $lang);
        return redirect()->back();
    })->middleware('language');
    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
    Route::middleware('auth:api')->get('/user', 'UserController@AuthRouteAPI');

});
