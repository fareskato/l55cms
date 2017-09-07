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
    // Category routes
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

    // Tag routes
    Route::resource('/tag', 'TagController',[
        'except' => ['destroy','update']
    ])->names('admin.tag');

    Route::get('tag/{id}/delete',[
        'uses' => 'TagController@delete',
        'as' => 'admin.tag.delete'
    ]);
    Route::post('tag/{id}/update',[
        'uses' => 'TagController@update',
        'as' => 'admin.tag.update'
    ]);
    // Post routes
    Route::resource('/post', 'PostController',[
        'except' => ['destroy','update']
    ])->names('admin.post');

    Route::get('post/{id}/delete',[
        'uses' => 'PostController@delete',
        'as' => 'admin.post.delete'
    ]);

    Route::post('post/{id}/update',[
        'uses' => 'PostController@update',
        'as' => 'admin.post.update'
    ]);
    Route::get('post/{id}/publish',[
        'uses' => 'PostController@publish',
        'as' => 'admin.post.publish'
    ]);

});


