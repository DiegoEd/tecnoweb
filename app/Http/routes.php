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

Route::get('clients/trash', 'ClientsController@trash');
Route::patch('clients/restore/{id}', 'ClientsController@restore');

Route::get('employees/trash', 'EmployeesController@trash');
Route::patch('employees/restore/{id}', 'EmployeesController@restore');

Route::get('accions/create/{id}', 'AccionsController@create');
Route::get('roles/signup/{id}', 'RolesController@signup');
Route::post('roles/commituser/', 'RolesController@commituser');

Route::resource('product-categories', 'ProductCategoriesController');
Route::resource('products', 'ProductsController');
Route::resource('clients', 'ClientsController');
Route::resource('users', 'UsersController');
Route::resource('suppliers', 'SuppliersController');
Route::resource('employees', 'EmployeesController');
Route::resource('customizes', 'CustomizesController');
Route::resource('modules', 'ModulesController');
Route::resource('accions', 'AccionsController');
Route::resource('roles', 'RolesController');
Route::resource('session', 'SessionController');


