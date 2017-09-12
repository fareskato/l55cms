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
    Route::get('category/search', [
        'uses' => 'CategoryController@search',
        'as' => 'admin.category.search'
    ]);
    Route::resource('/category', 'CategoryController',[
        'except' => ['destroy']
    ])->names('admin.category');
    Route::get('category/{id}/delete',[
        'uses' => 'CategoryController@delete',
        'as' => 'admin.category.delete'
    ]);

    // Tag routes
    Route::get('tag/search', [
        'uses' => 'TagController@search',
        'as' => 'admin.tag.search'
    ]);
    Route::resource('/tag', 'TagController',[
        'except' => ['destroy']
    ])->names('admin.tag');
    Route::get('tag/{id}/delete',[
        'uses' => 'TagController@delete',
        'as' => 'admin.tag.delete'
    ]);

    // Post routes
    Route::get('post/search', [
        'uses' => 'PostController@search',
        'as' => 'admin.post.search'
    ]);
    Route::resource('/post', 'PostController',[
        'except' => ['destroy']
    ])->names('admin.post');

    Route::get('post/{id}/delete',[
        'uses' => 'PostController@delete',
        'as' => 'admin.post.delete'
    ]);
    Route::get('post/{id}/publish',[
        'uses' => 'PostController@publish',
        'as' => 'admin.post.publish'
    ]);

    // User routes
    Route::get('/user',[
        'uses' => 'AdminController@list',
        'as' => 'admin.user.index'
    ]);
    Route::get('/user/create',[
        'uses' => 'AdminController@create',
        'as' => 'admin.user.create'
    ]);
    Route::post('/user',[
        'uses' => 'AdminController@store',
        'as' => 'admin.user.store'
    ]);

});


