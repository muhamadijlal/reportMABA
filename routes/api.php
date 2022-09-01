<?php

use App\Http\Controllers\ApieController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/reportPMB/index',[ApieController::class, 'index']);
Route::post('/reportPMB/store',[APieController::class, 'store']);
Route::get('/reportPMB/edit/{id}',[APieController::class, 'edit']);
Route::post('/reportPMB/update/{id}',[APieController::class, 'update']);
Route::get('/reportPMB/destroy/{id}',[APieController::class, 'destroy']);