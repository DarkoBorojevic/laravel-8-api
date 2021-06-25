<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthenticationController;

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

Route::post('/login', [AuthenticationController::class, 'login']);

Route::get('/products', [ProductController::class, 'index']);

Route::get('/products/{id}', [ProductController::class, 'show']);

Route::get('/search/{product}', [ProductController::class, 'search']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/register', [AuthenticationController::class, 'register']);

    Route::post('/products', [ProductController::class, 'store']);

    Route::put('/products/{id}', [ProductController::class, 'update']);

    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    Route::post('/logout', [AuthenticationController::class, 'logout']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();

});


