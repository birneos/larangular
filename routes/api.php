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


//Now if we want to protect a route, we may add the middleware into a route group:
//Route::group(['prefix' => 'v1', 'middleware' => ['cors', 'jwt.auth']], function(){

Route::group(['prefix' => 'v1', 'middleware' => 'cors'], function(){

    Route::resource('images', 'ImagesController');
    Route::resource('users', 'UsersController');
    Route::post('register', 'AuthController@postRegister');
    Route::post('login', 'AuthController@authenticate');
    Route::post('refresh', 'AuthController@refreshToken');
    

});


Route::group(['api' =>  'throttle:60,1'], function(){

     Route::resource('images', 'ImagesController');
});