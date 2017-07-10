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

Route::get('/', function () {
    return view('welcome');
});


Route::get('products/trash', 'ProductsController@trash');
Route::patch('products/restore/{id}', 'ProductsController@restore');

Route::get('product-categories/trash', 'ProductCategoriesController@trash');
Route::patch('product-categories/restore/{id}', 'ProductCategoriesController@restore');

Route::resource('product-categories', 'ProductCategoriesController');
Route::resource('products', 'ProductsController');
Route::resource('clients', 'ClientsController');
Route::resource('users', 'UsersController');
Route::resource('suppliers', 'SuppliersController');
Route::resource('employees', 'EmployeesController');
Route::resource('customizes', 'CustomizesController');
Route::resource('session', 'SessionController');