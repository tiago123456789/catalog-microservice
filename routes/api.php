<?php

use App\Http\Controllers\Api\CategoryController;
use App\User;
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

Route::group([ "namespace" => "Api" ], function() {

    Route::get("/categories", "CategoryController@index");
    Route::get("/categories/{id}", "CategoryController@show");
    Route::post("/categories", "CategoryController@store");
    Route::put('/categories/{id}', "CategoryController@update");
    Route::delete('/categories/{id}', "CategoryController@destroy");

});

