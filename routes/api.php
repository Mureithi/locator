<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('counties','CountiesController');
Route::get('subcounties/all','SubCountiesController@index');

Route::get('subcounties/search','SubCountiesController@search');

Route::get('wards/search','WardsController@search');

Route::get('wards/scrape','WardsController@scrape');
