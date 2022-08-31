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

Route::get('/index',[ApieController::class, 'index']);
Route::post('/store',[APieController::class, 'store']);
Route::get('/edit/{id}',[APieController::class, 'edit']);
Route::post('/update/{id}',[APieController::class, 'update']);
Route::get('/destroy/{id}',[APieController::class, 'destroy']);