<?php

use App\Http\Controllers\API\Admin\EmployeesController;
use Illuminate\Support\Facades\Route;

Route::get('index', [EmployeesController::class, 'index'])->name('index');
Route::get('show/{employee}', [EmployeesController::class, 'show'])->name('show');
Route::post('store', [EmployeesController::class, 'store'])->name('store');
Route::patch('update/{employee}', [EmployeesController::class, 'update'])->name('update');
Route::delete('destroy/{employee}', [EmployeesController::class, 'destroy'])->name('destroy');
