<?php

// use App\Notifications\JobUpdated;

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


// Auth::loginUsingId(43);
// Route::get('incompatible_browser', ['as' => 'incompatible_browser', 'uses' => 'ErrorController@incompatible_browser']);

// Login
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Auth::routes();

// Company
Route::resource('company', 'CompaniesController');

// Engagement
Route::resource('engagement', 'EngagementController');

//
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');


// staff
Route::resource('staff', 'StaffsController');
Route::get('staff/{staff}', 'StaffsController@show');
Route::get('profile/edit', 'StaffsController@edit');
Route::patch('profile/update', 'StaffsController@update');
Route::post('staff/{staff}/assign_role', 'StaffsController@assign_role');
Route::patch('staff/{staff}/status', 'StaffsController@status');
Route::patch('staff/{staff}/edit_position', 'StaffsController@edit_position');
Route::post('staff/{staff}/salary', 'StaffsController@salary');


// user setting - email
Route::get('email', 'StaffsController@edit_email');
Route::patch('email', 'StaffsController@update_email');


// Role Routes...
Route::resource('role', 'RolesController');
Route::post('role/{role}/assign_permission', 'RolesController@assign_permission');
Route::patch('role/{role}/status', 'RolesController@status');

// Permission Routes...
Route::resource('permission', 'PermissionsController');
Route::patch('permission/{permission}/status', 'PermissionsController@status');



// job
// Route::get('job/new', 'JobsController@create');
Route::resource('job', 'JobsController');
Route::patch('job/{job}/complete', 'JobsController@complete');
Route::patch('job/{job}/review', 'JobsController@review');

Route::post('job/{job}/assign', 'JobsController@assign');
Route::post('job/{job}/track', 'JobsController@track');


// report
Route::get('report', 'ReportController@index');
Route::get('revenue', 'ReportController@revenue');
Route::get('high_variance', 'ReportController@high_variance');
Route::get('staff_earn', 'ReportController@staff_earn');
Route::get('engagement_revenue', 'ReportController@engagement_revenue');
// Route::get('budget_hour', 'ReportController@budget_hour');
