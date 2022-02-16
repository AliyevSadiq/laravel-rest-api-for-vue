<?php

use App\Http\Controllers\AuthController;
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


Route::post('/auth/register', [AuthController::class, 'register']);

Route::post('/auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::apiResource('category',\App\Http\Controllers\CategoryController::class);
    Route::get('article','\App\Http\Controllers\ArticleController@index');
    Route::post('article','\App\Http\Controllers\ArticleController@store');
    Route::get('article/{article}','\App\Http\Controllers\ArticleController@show');
    Route::post('article/{article}','\App\Http\Controllers\ArticleController@update');
    Route::delete('article/{article}','\App\Http\Controllers\ArticleController@destroy');
});

