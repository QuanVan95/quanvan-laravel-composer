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
Route::post('/users/login', ['as' => 'login', 'uses' => 'UserController@login']);

#Group APIs with JWT middleware
Route::middleware(['jwt'])->group(function () {
    Route::get('users/check-authentication', ['as' => 'check-authentication', 'uses' => 'UserController@checkAuthentication']);
});

//Route::group(['prefix' => 'v1',  'middleware' => 'jwt'], function()
//{
//    Route::get('users/check-authentication', ['as' => 'check-authentication', 'uses' => 'UserController@checkAuthentication']);
//});

Route::get('laravel-demo', function(){
    echo 'Hello from the laravel package!';
});
