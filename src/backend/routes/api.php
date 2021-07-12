<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\IAmAliveController;
use App\Http\Controllers\Api\InviteController;
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

Route::get('i-am-alive', [IAmAliveController::class, 'handle']);
Route::post('auth/register', [AuthController::class, 'register']);

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/login', ['as' => 'login', 'uses' => 'App\Http\Controllers\Api\AuthController@login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/invite', [InviteController::class, 'invite']);

    Route::get('/me', function (Request $request) {
        return auth()->user();
    });

    Route::post('auth/logout', [AuthController::class, 'logout']);
});
