<?php
use Illuminate\Support\Facades\Route;
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
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/home','HomeController@index');

    // Company
    Route::get('/company', 'CompanyController@index')->name('company.index');
    Route::post('/sample_form', 'CompanyController@store')->name('store');
    Route::get('/edit_company/{id}', 'CompanyController@edit')->name('edit');
    Route::post('update_company/{id}', 'CompanyController@update')->name('update_company');
    Route::get('delete/{id}', 'CompanyController@delete')->name('delete');

    // Role
    Route::get('/role', 'RoleController@index')->name('role.index');
    Route::post('/new_role', 'RoleController@store')->name('role.store');
    Route::get('/edit_role/{id}', 'RoleController@edit')->name('edit_role');
    Route::post('update_role/{id}', 'RoleController@update')->name('update_role');
    Route::get('delete_role/{id}', 'RoleController@delete')->name('delete_role');

    // Department
    Route::get('/department', 'DepartmentController@index')->name('department.index');
    Route::post('/new_department', 'DepartmentController@store')->name('department.store');
    Route::get('/edit_department/{id}', 'DepartmentController@edit')->name('edit_department');
    Route::post('update_department/{id}', 'DepartmentController@update')->name('update_department');
    Route::get('delete_department/{id}', 'DepartmentController@delete')->name('delete_department');

    // Product
    Route::get('/product', 'ProductController@index')->name('product.index');

    // Client
    Route::get('/client', 'ClientController@index')->name('client.index');

    // Customer Requirement
    Route::get('/customer_requirement', 'CustomerRequirementController@index')->name('customer_requirement.index');

    // Product Evaluation
    Route::get('/product_evaluation', 'ProductEvaluationController@index')->name('product_evaluation.index');

    // Sample Request 
    Route::get('/sample_request', 'SampleRequestController@index')->name('sample_request.index');

    // Price Monitoring 
    Route::get('/price_monitoring', 'PriceMonitoringController@index')->name('price_monitoring.index');

    // Customer Complaint 
    Route::get('/customer_complaint', 'CustomerComplaintController@index')->name('customer_complaint.index');
});