<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServicesApiController;
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

Route::middleware('auth:api')->get('/text', [App\Http\Controllers\Api\ServicesApiController::class, 'index']);

Route::middleware('auth:api')->get('/factory', [App\Http\Controllers\Api\ServicesApiController::class, 'factory']);

//Route::middleware('auth:api')->get('/oauth', [App\Http\Controllers\Api\ServicesApiController::class, 'oauthKey']);

Route::middleware('auth:api')->get('/oauth', function (Request $request) {
    $con = new App\Http\Controllers\Api\ServicesApiController;
	
	return $con->callAction('sendKey', ['data_id' => array('id'=>4)]);
});

Route::post('/get', [App\Http\Controllers\Api\Auth\AuthController::class, 'get_api']);