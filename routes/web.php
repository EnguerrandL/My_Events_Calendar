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

Route::get('/', 'EventsController@index');
Route::post('/', 'EventsController@store');
route::put('/{id}', 'EventsController@update')->name('update');
route::delete('/{id}', 'EventsController@destroy');


// Function 

Route::get('setColorStatus/', 'EventsController@setColorStatus'); 