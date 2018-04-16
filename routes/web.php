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
| Item
|--------------------------------------------------------------------------
*/
Route::resource ('items', 'ItemsController');
Route::put      ('items/increment/{item}', 'ItemsController@increment'  )->name('items.increment');
Route::put      ('items/decrement/{item}', 'ItemsController@decrement'  )->name('items.decrement');
Route::post     ('items/makeJukebox',      'ItemsController@makeJukebox')->name('items.makeJukebox');

Route::get('/', function() {
    return redirect('items.index');
});


/*———————————————————————————————————*\
    $ UPLOAD
\*———————————————————————————————————*/
Route::post('upload/item/image', 'UploadController@imageItem')
    ->name('upload.imageItem')
;

/*———————————————————————————————————*\
        $ AUTH
\*———————————————————————————————————*/
Auth::routes();