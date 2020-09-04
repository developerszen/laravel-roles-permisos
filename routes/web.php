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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'PostController@index')->name('home');

Route::resource('users', 'UserController');

Route::post('posts/{post}/comments', 'PostController@comment')->name('posts.comments.store');
Route::post('posts/{post}/comments/{comment}', 'PostController@salientComment')->name('posts.comments.salient');

Route::resource('posts', 'PostController', ['except' => ['index']]);



