<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Event::listen('illuminate.query', function($query)
// {
//     var_dump($query);
// });

Route::get('/', ['as' => 'categories.index', 'uses' => 'CategoriesController@index']);
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);
Route::resource('products',   'ProductsController',   ['only' => ['show']]);

// TODO: add middleware
Route::group(['prefix' => 'admin'], function()
{
    Route::get('/products',                     ['as' => 'admin.products.index',                  'uses' => 'Admin\ProductsController@index']);
    Route::get('/products/new/select-category', ['as' => 'admin.products.create.select_category', 'uses' => 'Admin\ProductsController@create_select_category']);
    Route::get('/products/new',                 ['as' => 'admin.products.create',                 'uses' => 'Admin\ProductsController@create']);
    Route::post('/products',                    ['as' => 'admin.products.store',                  'uses' => 'Admin\ProductsController@store']);
    Route::get('/products/{id}/edit',           ['as' => 'admin.products.edit',                   'uses' => 'Admin\ProductsController@edit']);
    Route::put('/products/{id}',                ['as' => 'admin.products.update',                 'uses' => 'Admin\ProductsController@update']);
    Route::delete('/products/{id}',             ['as' => 'admin.products.destroy',                'uses' => 'Admin\ProductsController@destroy']);
});
