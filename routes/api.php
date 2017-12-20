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

//Route::post('saveOrUpdate','SaveOrUpdateControler@saveOrUpdate')->name('saveOrUpdate');
Route::post('store','AdresarController@store');
Route::post('loadData','AdresarController@show');
Route::post('delData','AdresarController@destroy');
Route::post('updateData','AdresarController@update');

