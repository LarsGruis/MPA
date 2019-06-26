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

Route::resource('shares', 'ShareController');

Route::resource('categories', 'CategoriesController');

Route::view('/upload', "upload");

Route::post('/store', "ShareController@store");

Route::get('/share/{share}', [ 'as' => 'shares.getDetails', 'uses' => 'ShareController@getDetails']);

Route::get('/add-to-cart/{id}', [
	'uses' => 'ShareController@getAddToCart', 
	'as' => 'shares.addToCart'
]);

Route::get('/reduce/{id}', [
	'uses' => 'ShareController@deleteProduct',
	'as' => 'shares.deleteProduct'
]);

Route::get('/shopping-cart', [
	'uses' => 'ShareController@getCart', 
	'as' => 'shares.shoppingCart'
]);

Route::get('/remove/{id}', [
	'uses' => 'ShareController@getRemoveProduct',
	'as' => 'shares.getRemoveProduct'
]);

// Route::get('shares.index', [
// 	'uses' => 'ShareController@getCart', 
// 	'as' => 'shares.shoppingCart'
// ]);

Route::get('/shopping-cart', 'ShareController@getCart');
Route::get('/delete-cart', 'ShareController@deleteCart');
Route::get('/delete-product', 'ShareController@deleteProduct');


Auth::routes();

//Route::get('/shares', 'HomeController@index')->name('home');
// Route::get('/delete-cart', ['uses' => 'ShareController@deleteCart', 'as' => 'shares.deleteCart']);

// Route::get('shares', [ 'as' => 'shares.deleteCart', 'uses' => 'ShareController@deleteCart']);
// Route::get('/shopping-cart', 'ShareController@deleteCart')->name('deleteCart');
// Route::get('user/profile', 'UserProfileController@show')->name('profile');

//Route::get('/home', 'HomeController@index')->name('home');
