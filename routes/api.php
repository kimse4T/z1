<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->group(function(){

    Route::put('/property/status/{id}','Admin\PropertyCrudController@updateStatus');

    Route::put('/property/indication/{id}','Admin\PropertyCrudController@updateIndication');

    Route::post('/property/task/','Admin\Tasks_activityCrudController@storeFromProperty');

    Route::post('/listing/create/{id}','Admin\ListingCrudController@store');

    Route::resource('accounts', 'API\AccountAPIController');

    Route::resource('contacts', 'API\ContactAPIController');

    Route::resource('properties', 'API\PropertyAPIController');
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'AuthApiController@login')->name('login');
    Route::post('signup', 'AuthApiController@signup');
});
