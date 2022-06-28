<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoGameController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

*/


Route::group(['middleware' => ['cors']], function () {
    Route::apiResource('videogames', VideoGameController::class);
    
    Route::prefix('auth')->group(function(){
        Route::post('/sign-in', [AuthController::class, 'login']);
        Route::post('/sign-up', [AuthController::class, 'register']);
    });

});

