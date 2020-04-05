<?php

use App\Contacts;

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

Route::get('/','ApiController@index')->name('welcome');
Route::get('/sss','ApiController@index2');
Route::get('/data','ApiController@getData');

Route::get('surveys/export/', 'ApiController@export');


Route::get('data','API\RegisterController@index');

Route::get('category', 'DatatablesController@index');
Route::get('get-category-data', 'DatatablesController@categoryData')->name('datatables.category');

