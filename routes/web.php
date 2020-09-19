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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'PostController@index')->name('home');

    Route::resource('users', 'UserController');

    Route::post('posts/{post}/publish', 'PostController@publish')->name('posts.publish');
    Route::post('posts/{post}/unpublish', 'PostController@unpublish')->name('posts.unpublish');
    Route::post('posts/{post}/comments', 'PostController@comment')->name('posts.comments.store');
    Route::post('posts/{post}/comments/{comment}', 'PostController@salientComment')->name('posts.comments.salient');

    Route::middleware(['permission:write post'])->group(function() {

        Route::post('posts', 'PostController@store')->name('posts.store');
        Route::get('posts/create', 'PostController@create')->name('posts.create');

    });

    Route::resource('posts', 'PostController', ['except' => ['index', 'show', 'create', 'store']]);
});

Route::get('posts/{post}', 'PostController@show')->name('posts.show');



