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
    return view('home');
})->name('home');

Auth::routes();

/**
 * All admin routes
 */
Route::group(['prefix' => 'admin'], function (){
    Route::get('/', 'AdminController@index')->name('admin');
    // All category model routes
    Route::resource('/category', 'CategoryController',[
        'except' => ['destroy','update']
    ])->names('admin.category');

    Route::get('category/{id}/delete',[
        'uses' => 'CategoryController@delete',
        'as' => 'admin.category.delete'
    ]);

    Route::post('category/{id}/update',[
        'uses' => 'CategoryController@update',
        'as' => 'admin.category.update'
    ]);

});


