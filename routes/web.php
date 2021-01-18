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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'API\ApiController@view');
Route::get('tag/add','API\ApiController@create');
Route::post('tag/add','API\ApiController@store');
Route::get('tags','API\ApiController@index');
Route::get('tag/chart','API\ApiController@chart');