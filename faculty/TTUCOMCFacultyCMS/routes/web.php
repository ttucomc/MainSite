<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', function () {
  return view('auth.login');
});

Route::get('/home', 'HomeController@index');

Route::get('/logout', 'Auth\LoginController@logout');

Route::post('/emailAdmin', 'EmailController@sendEmailToAdmin');

Route::post('/create-faculty', 'AdminController@createFaculty');

Route::get('/admin-approve-changes/{id}', 'AdminController@approveChanges');

Route::get('/admin-create-faculty', function() {
  return view('admin-create-faculty');
});
