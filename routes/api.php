<?php

use App\Http\Controllers\API\ComplimentsController;
use App\Http\Controllers\ParserController;
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

Route::middleware('auth:api')->get(
    '/user',
    function (Request $request) {
        return $request->user();
    }
);
Route::prefix('/compliments')->group(
    function () {
        Route::post('/create', [ComplimentsController::class, 'create']);
        Route::post('/category/{categoryId}/rand', [ComplimentsController::class, 'randByCategory']);
        Route::delete('/{complimentId}', [ComplimentsController::class, 'delete']);
        Route::get('/', [ComplimentsController::class, 'list']);
        Route::get('/category/{categoryId}', [ComplimentsController::class, 'listByCategory']);
        Route::get('/{complimentId}/category/{categoryId}', [ComplimentsController::class, 'attachToCategory']);
    }
);

Route::get('/parser', [ParserController::class, 'parse']);