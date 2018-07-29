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

Route::get('v1/user', 'API\v1\User\GetController');
Route::post('v1/user', 'API\v1\User\AddController');
Route::put('v1/user/{id}', 'API\v1\User\UpdateController');
Route::delete('v1/user/{id}', 'API\v1\User\DeleteController');
