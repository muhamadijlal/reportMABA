<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RegisterController;
use Maatwebsite\Excel\Importer;

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
  // Login
  Route::get('/', function () {return redirect('/login');});
  Route::get('/login', [LoginController::class, 'index'])->name('login');
  Route::post('/login', [LoginController::class, 'authenticate']);
  // Register
  Route::get('/register',[RegisterController::class, 'index']);
  Route::post('/register',[RegisterController::class, 'store']);
});

Route::middleware('auth')->group( function(){  

  // Dashboard
  Route::get('/dashboard', [ReportController::class, 'index'])->name('dashboard');
  Route::get('/dashboard/report/detail/{id}', [ReportController::class, 'show'])->name('detail-report');
  // Logout
  Route::post('/logout', [LoginController::class, 'logout']);
  // Menu's
  Route::prefix('menu')->group( function(){
    // Report
    Route::get('/add-report', [ReportController::class, 'create'])->name('add-report');
    Route::post('/add-report/store', [ReportController::class, 'store']);
    Route::post('/report/json', [ReportController::class, 'report_json']);
    Route::get('/report/edit/{id}', [ReportController::class, 'edit'])->name('edit-report');
    Route::post('/report/update/{id}', [ReportController::class, 'update']);
    Route::get('/report/destroy/{id}', [ReportController::class, 'destroy']);
    // Import
    Route::get('/import-mahasiswa', [ImportController::class, 'index'])->name('import');
    Route::post('/import-mahasiswa', [ImportController::class, 'import_json']);
    Route::post('/import', [ImportController::class, 'MahasiswaBaruImport']);
    Route::post('/import/delete-periode', [ImportController::class, 'destroy']);
    // Add data manualy
    Route::get('/import-mahasiswa/create', [ImportController::class, 'create'])->name('create');
    Route::post('/import-mahasiswa/store', [ImportController::class, 'store'])->name('store');

    // report data
    Route::get('/data-report', [ReportController::class, 'index_report']);
  });
}); 

