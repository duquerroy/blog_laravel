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


Route::get('/', 'PostController@index')->name('post');
Route::get('/posts/{id}', 'PostController@view');
Route::get('/post_add', 'PostController@create')->middleware('auth');
Route::post('/post_add', 'PostController@store')->middleware('auth');
Route::delete('/posts/{id}', 'PostController@delete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
