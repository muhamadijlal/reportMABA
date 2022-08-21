<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\PostController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RegisterController;
use Facade\FlareClient\Truncation\ReportTrimmer;

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
  Route::get('/dashboard', [ReportController::class, 'index']);
  Route::get('/add-report', [ReportController::class, 'create']);
  Route::post('/add-report/store', [ReportController::class, 'store']);
  Route::post('/report/json', [ReportController::class, 'report_json']);
  Route::get('/report/edit/{id}', [ReportController::class, 'edit']);
  Route::post('/report/update/{id}', [ReportController::class, 'update']);
  Route::get('/report/destroy/{id}', [ReportController::class, 'destroy']);

  Route::get('/import-mahasiswa', [ImportController::class, 'index']);
  Route::post('/import-mahasiswa', [ImportController::class, 'import_json']);
  Route::post('/import', [ImportController::class, 'MahasiswaBaruImport']);
  Route::post('/import/delete-periode', [ImportController::class, 'destroy']);
  Route::post('/logout', [LoginController::class, 'logout']);
}); 

