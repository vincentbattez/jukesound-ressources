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


/*
|--------------------------------------------------------------------------
| Item DASHBOARD
|--------------------------------------------------------------------------
*/
Route::resource('items', 'ItemsController');

Route::put('items/{item}', 'ItemsController@countIncrement')->name('items.countIncrement');

Route::get('/', function() {
    return redirect('/items');
});