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

    // Nature of Request
    Route::get('/nature_request', 'NatureRequestController@index')->name('nature_request.index');

    // Project Name
    Route::get('/project_name', 'ProjectNameController@index')->name('project_name.index');

    // CRR Priority
    Route::get('/crr_priority', 'CrrPriorityController@index')->name('crr_priority.index');

    // Issue Category
    Route::get('/issue_category', 'IssueCategoryController@index')->name('issue_category.index');

    // Concerned Department
    Route::get('/concern_department', 'ConcernDepartmentController@index')->name('concern_department.index');

    // Activities
    Route::get('/activities', 'ActivityController@index')->name('activities.index');

    // Product Applications
    Route::get('/product_applications', 'ProductApplicationController@index')->name('product_applications.index');

    // Product Subcategories
    Route::get('/product_subcategories', 'ProductSubcategoriesController@index')->name('product_subcategories.index');

    // Raw Material
    Route::get('/raw_material', 'RawMaterialController@index')->name('raw_material.index');

    // Price Request Fixed Cost
    Route::get('/price_fixed_cost', 'RawMaterialController@index')->name('price_fixed_cost.index');

    // Price Request GAE
    Route::get('/raw_material', 'RawMaterialController@index')->name('raw_material.index');

    // Region
    Route::get('/region', 'RegionController@index')->name('region.index');
    Route::post('/new_region', 'RegionController@store')->name('region.store');
    Route::get('/edit_region/{id}', 'RegionController@edit')->name('edit_region');
    Route::post('update_region/{id}', 'RegionController@update')->name('update_region');
    Route::get('delete_region/{id}', 'RegionController@delete')->name('delete_region');

    // Country
    Route::get('/country', 'CountryController@index')->name('country.index');
    Route::post('/new_country', 'CountryController@store')->name('country.store');
    Route::get('/edit_country/{id}', 'CountryController@edit')->name('edit_country');
    Route::post('update_country/{id}', 'CountryController@update')->name('update_country');
    Route::get('delete_country/{id}', 'CountryController@delete')->name('delete_country');

    // Area
    Route::get('/area', 'AreaController@index')->name('area.index');
});
