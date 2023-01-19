<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function(){
    Route::prefix('admin')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');

        Route::prefix('companies')->group(function () {
            Route::get('/', [CompanyController::class, 'index'])->name('companies');
            Route::get('/create', [CompanyController::class, 'create'])->name('company.create');
            Route::post('/store', [CompanyController::class, 'store'])->name('company.store');
            Route::get('/{id}', [CompanyController::class, 'show'])->name('company.show');
            Route::get('/{id}/edit', [CompanyController::class, 'edit'])->name('company.edit');
            Route::post('/{id}/update', [CompanyController::class, 'update'])->name('company.update');
            Route::get('/{id}/delete', [CompanyController::class, 'destroy'])->name('company.destroy');
        });

        Route::prefix('employees')->group(function () {
            Route::get('/', [EmployeeController::class, 'index'])->name('employees');
            Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
            Route::post('/store', [EmployeeController::class, 'store'])->name('employee.store');
            Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
            Route::post('/{id}/update', [EmployeeController::class, 'update'])->name('employee.update');
            Route::get('/{id}/delete', [EmployeeController::class, 'destroy'])->name('employee.destroy');
        });
    });
});
