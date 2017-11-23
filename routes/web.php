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
Auth::routes();
Route::get('/','ChatController@index');

Route::post('chat','ChatController@store');
Route::get('chat/ajax','ChatController@getchat');


//Route::get('/', 'HomeController@index')->name('home');
