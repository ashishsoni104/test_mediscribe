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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//company
Route::get('/companylist','CompanyController@getCompanyRecords');
Route::get('/add-company','CompanyController@addCompany');
Route::post('/save-company','CompanyController@saveCompany');
Route::post('/edit-company','CompanyController@editCompany');
Route::get('/edit-company/{company_id}','CompanyController@getSingleCompany');
Route::get('/delete-company/{company_id}','CompanyController@deleteCompany');

//employee
Route::get('/employeelist','EmployeeController@getEmployeeRecords');
Route::get('/add-employee','EmployeeController@addEmployee');
Route::post('/save-employee','EmployeeController@saveEmployee');
Route::post('/edit-employee','EmployeeController@editEmployee');
Route::get('/edit-employee/{employee_id}','EmployeeController@getSingleEmployee');
Route::get('/delete-employee/{employee_id}','EmployeeController@deleteEmployee');