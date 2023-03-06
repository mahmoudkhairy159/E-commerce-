<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Auth::routes();

Route::group([
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'prefix' => LaravelLocalization::setLocale()
], function () {


    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home')->middleware('auth:web');

    Route::middleware(['auth:web'])->prefix('user')->group(function () {
        //products
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/products/', 'ProductController@indexUser')->name('indexUser');
        Route::get('/newestProducts/', 'ProductController@indexNewestProducts')->name('indexNewestProducts');
        Route::get('/lowestPriceProducts/', 'ProductController@indexLowestPriceProducts')->name('indexLowestPriceProducts');
        Route::get('/highestPriceProducts/', 'ProductController@indexHighestPriceProducts')->name('indexHighestPriceProducts');
        Route::get('/products/men', 'ProductController@indexMenProducts')->name('indexMenProducts');
        Route::get('/products/women', 'ProductController@indexWomenProducts')->name('indexWomenProducts');
        Route::get('/Products/kids', 'ProductController@indexKidsProducts')->name('indexKidsProducts');
        Route::get('/products/{product}/', 'ProductController@showUser')->name('showUser');
        //cart
        Route::post('/products/addToCart/', 'CartController@addToCart')->name('addToCart');
        Route::post('/products/editProductQuantityInCartList/', 'CartController@editProductQuantity')->name('editProductQuantity');
        Route::get('/cartList/', 'CartController@showCartList')->name('showCartList');
        Route::get('/removeProductfromCartList/{productId}', 'CartController@removeProductfromCartList')->name('removeProductfromCartList');
        //order
        Route::get('/orderNow', 'OrderController@confirmOrder')->name('confirmOrder');
        Route::get('/myOrders', 'OrderController@showOrders')->name('showOrders');
        //payment gateway
        Route::get('/prepareCheckout/', 'PaymentProviderController@prepareCheckout')->name('prepareCheckout');
        //User
        Route::resource('users','UserController')->except([
            'create', 'store','edit','index','destroy'
        ]);
        Route::put('/changePassword/{id}', 'UserController@changePassword')->name('users.changePassword');      
    });
});



