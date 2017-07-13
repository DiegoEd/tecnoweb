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
Route::get('sale-bill-details/create/{id}', 'SaleBillDetailsController@create');
Route::get('purchases-bill-details/create/{id}', 'PurchasesBillDetailsController@create');
Route::get('session/close', 'SessionController@shutdown');
Route::get('roles/signup/{id}', 'RolesController@signup');
Route::post('roles/commituser/', 'RolesController@commituser');
Route::get('/main','ModulesController@main'); 

Route::get('sales-bills/statistics', 'SalesBillsController@statistics');


Route::get('clients/index/{accion}', 'ClientsController@index');
Route::get('clients/indexedit/{accion}', 'ClientsController@index');
Route::get('clients/indexdelete/{accion}', 'ClientsController@index');

Route::get('products/index/{accion}', 'ProductsController@index');
Route::get('products/indexedit/{accion}', 'ProductsController@index');
Route::get('products/indexdelete/{accion}', 'ProductsController@index');

Route::get('product-categories/index/{accion}', 'ProductCategoriesController@index');
Route::get('product-categories/indexedit/{accion}', 'ProductCategoriesController@index');
Route::get('product-categories/indexdelete/{accion}', 'ProductCategoriesController@index');

Route::get('suppliers/index/{accion}', 'SuppliersController@index');
Route::get('suppliers/indexedit/{accion}', 'SuppliersController@index');
Route::get('suppliers/indexdelete/{accion}', 'SuppliersController@index');

Route::get('employees/index/{accion}', 'EmployeesController@index');
Route::get('employees/indexedit/{accion}', 'EmployeesController@index');
Route::get('employees/indexdelete/{accion}', 'EmployeesController@index');

Route::get('sales-bills/index/{accion}', 'SalesBillsController@index');
Route::get('sales-bills/indexdelete/{accion}', 'SalesBillsController@index');

Route::get('purchases-bills/index/{accion}', 'PurchasesBillsController@index');
Route::get('purchases-bills/indexdelete/{accion}', 'PurchasesBillsController@index');

Route::get('roles/index/{accion}', 'RolesController@index');
Route::get('roles/indexedit/{accion}', 'RolesController@index');
Route::get('roles/indexdelete/{accion}', 'RolesController@index');
Route::get('roles/index/{accion}', 'RolesController@index');
Route::get('modules/search', 'ModulesController@search');

##acciones descontinuadas
/*Route::get('modules/signup/{id}', 'ModulesController@signup');
Route::post('modules/commitaccions/', 'ModulesController@commitaccions');*/


Route::get('module/generateview/{id}', 'ModulesController@generateview');

Route::resource('product-categories', 'ProductCategoriesController');
Route::resource('products', 'ProductsController');
Route::resource('clients', 'ClientsController', ['except' => ['index']]);
Route::resource('suppliers', 'SuppliersController');
Route::resource('employees', 'EmployeesController');
Route::resource('customizes', 'CustomizesController');
Route::resource('modules', 'ModulesController', ['except' => ['create']]);
Route::resource('accions', 'AccionsController', ['except' => ['create']]);
Route::resource('roles', 'RolesController');
Route::resource('session', 'SessionController');

Route::resource('sales-bills', 'SalesBillsController');
Route::resource('sale-bill-details', 'SaleBillDetailsController');
Route::resource('purchases-bills', 'PurchasesBillsController');
Route::resource('purchases-bill-details', 'PurchasesBillDetailsController');