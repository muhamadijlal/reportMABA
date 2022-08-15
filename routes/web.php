<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group( function() {
  Route::get('/', function () {return redirect('/login');});
  Route::get('/login', [LoginController::class, 'index'])->name('login');
  Route::post('/login', [LoginController::class, 'authenticate']);
  Route::get('/register',[RegisterController::class, 'index']);
  Route::post('/register',[RegisterController::class, 'store']);
});

Route::middleware('auth')->group( function(){
  Route::get('/dashboard', [PostController::class, 'index']);
  Route::post('/json', [PostController::class, 'json']);
  // Route::get('/export', [PostController::class, 'MahasiswaBaruExport']);
  Route::post('/import', [PostController::class, 'MahasiswaBaruImport']);
  Route::post('/logout', [LoginController::class, 'logout']);
}); 

