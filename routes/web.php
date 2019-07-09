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
Auth::routes();
Route::resource('test', 'TestController');

Route::resource('students', 'StudentController');

Route::resource('products', 'ProductController');

Route::resource('categories', 'CategoriesController');

Route::resource('orders', 'OrdersController');

Route::view('/upload', "upload");

Route::post('/store', "ProductController@store");

Route::post('/store-order', "OrderController@store");

Route::get('/product/{product}', [ 'as' => 'products.getDetails', 'uses' => 'ProductController@getDetails']);

Route::get('/add-to-cart/{id}', [
	'uses' => 'ProductController@getAddToCart', 
	'as' => 'products.addToCart'
]);

Route::get('/reduce/{id}', [
	'uses' => 'ProductController@deleteProduct',
	'as' => 'products.deleteProduct'
]);

Route::get('/shopping-cart', [
	'uses' => 'ProductController@getCart', 
	'as' => 'products.shoppingCart'
]);

Route::get('/remove/{id}', [
	'uses' => 'ProductController@getRemoveProduct',
	'as' => 'products.getRemoveProduct'
]);

Route::get('/checkout', [
	'uses' => 'OrdersController@getCheckout',
	'as' => 'checkout' 
]);

Route::post('/checkout', [
	'uses' => 'OrdersController@postCheckout',
	'as' => 'checkout'
]);

Route::get('/orders', [
	'uses' => 'OrdersController@index',
	'as' => 'orders'
]);

Route::get('/deleteCartAfterOrder', [
	'uses' => 'OrdersController@index',
	'as' => 'orders'
]);

Route::get('/viewcart', 'CartController@getCart')->name('viewCart');

Route::get('/delete-after-order', [
	'uses' => 'ProductController@deleteCartAfterOrder',
	'as' => 'products.deleteCartAfterOrder'
]);

// Route::get('products.index', [
// 	'uses' => 'ProductController@getCart', 
// 	'as' => 'products.shoppingCart'
// ]);

Route::get('/shopping-cart', 'ProductController@getCart');
Route::get('/delete-cart', 'ProductController@deleteCart');
Route::get('/delete-product', 'ProductController@deleteProduct');


Auth::routes();

//Route::get('/products', 'HomeController@index')->name('home');
// Route::get('/delete-cart', ['uses' => 'ProductController@deleteCart', 'as' => 'products.deleteCart']);

// Route::get('products', [ 'as' => 'products.deleteCart', 'uses' => 'ProductController@deleteCart']);
// Route::get('/shopping-cart', 'ProductController@deleteCart')->name('deleteCart');
// Route::get('user/profile', 'UserProfileController@show')->name('profile');

//Route::get('/home', 'HomeController@index')->name('home');
