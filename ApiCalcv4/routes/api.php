<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\calcController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/leftValue/{a}', [calcController::class, 'leftValue']);
Route::post('/rightValue/{a}', [calcController::class, 'rightValue']);
Route::post('/operation/{a}', [calcController::class, 'operation']);
Route::get('/result', [calcController::class, 'result']);
Route::get('/history', [calcController::class, 'history']);


