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
Route::get('/shopping-cart', [
	'uses' => 'ShareController@getCart', 
	'as' => 'shares.shoppingCart'
]);