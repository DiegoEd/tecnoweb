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

<<<<<<< HEAD
Route::resource('supplier', 'SupplierController');
Route::post('store', 'SupplierController@store');
=======

Route::resource('product-categories', 'ProductCategoriesController');
Route::resource('products', 'ProductsController');
>>>>>>> efd83bbe16e867d16d571bcf9e87a177a85e6642
