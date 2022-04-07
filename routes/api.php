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
Route::group(['prefix' => '/', 'namespace' => 'Api'], function (){

    //createSeller
    Route::post('/CreateSeller', ['as' => 'admin.CreateSeller', 'uses' => 'User\UserController@registerSeller']);
    Route::post('/CreateInvoice', ['as' => 'admin.CreateInvoice', 'uses' => 'User\UserController@CreateInvoice']);


});

