<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/
define('paginationCount',12);

Route::group([
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'prefix' => LaravelLocalization::setLocale()
], function () {
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');

Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::view('/dashboard', 'adminDashboard.dashboard');
    //admin
    Route::resource('admins','AdminController')->except([
        'create', 'store','edit','destroy'
    ]);
    Route::put('/changePassword/{id}', 'AdminController@changePassword')->name('admins.changePassword');
    //product
    Route::resource('products', 'ProductController');
    Route::post('/products/search', 'ProductController@searchForProduct')->name('searchForProduct');
    //usersTable
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/{id}', 'UserController@showUserForAdmin')->name('users.showUserForAdmin');
    Route::delete('/users/{id}', 'UserController@destroy')->name('users.destroy');





});
});
