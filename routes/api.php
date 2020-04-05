<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');

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

Route::post('register', 'LoginController@register');
Route::post('login', 'LoginController@login');


Route::get('user', 'UserController@getUserById');
Route::get('user_info/{token}', 'UserController@getUserInfo');
Route::get('users', 'UserController@getUsersListInfo');

// Publications API
Route::get('publication', 'PublicationController@getPublications');
Route::get('publication/{id}', 'PublicationController@getPublicationById');
Route::post('publication', 'PublicationController@createPublication');
