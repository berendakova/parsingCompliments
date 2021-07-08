<?php

use App\Http\Controllers\API\ComplimentsController;
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

Route::post('/compliments/create', [ComplimentsController::class, 'create']);
Route::post('/compliments/category/{categoryId}/rand', [ComplimentsController::class, 'randByCategory']);
Route::delete('/compliments/{complimentId}', [ComplimentsController::class, 'delete']);
Route::get('/compliments', [ComplimentsController::class, 'list']);
Route::get('/compliments/category/{categoryId}', [ComplimentsController::class, 'listByCategory']);
Route::get('/compliments/{complimentId}/category/{categoryId}', [ComplimentsController::class, 'attachToCategory']);