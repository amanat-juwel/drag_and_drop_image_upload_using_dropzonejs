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

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::get('/item/create', 'ItemController@create');

Route::post('/item', 'ItemController@store');

Route::post('/item/image/upload', 'ItemController@fileUpload');
Route::get('/item/image/delete', 'ItemController@removeUpload');
