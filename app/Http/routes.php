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
Route::get('/main', function () {
	return view('main');
});


Route::get('clients/index/{accion}', 'ClientsController@index');
Route::get('clients/indexedit/{accion}', 'ClientsController@index');
Route::get('clients/indexdelete/{accion}', 'ClientsController@index');


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