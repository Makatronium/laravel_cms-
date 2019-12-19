<?php

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
    return view('welcome');
});

Route::match(['get','post'], '/admin', 'AdminController@login');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/homepage','AdminController@index');

Route::get('/admin/about','AdminController@about');

Route::get('/admin/domain','AdminController@domain');

Route::get('/admin/hosting','AdminController@hosting');

Route::get('/admin/blog','AdminController@blog');

Route::get('/admin/contact','AdminController@contact');

Route::get('/admin/dashboard','AdminController@dashboard');

Route::get('/admin/settings','AdminController@settings');

Route::get('/admin/donate','AdminController@donate');

Route::get('/admin/check-pwd','AdminController@checkPassword');

Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');

Route::get('/logout','AdminController@logout');

Route::resource('users', 'UserController');