<?php

use App\Http\Controllers\API\Admin\EmployeesController;
use Illuminate\Support\Facades\Route;

Route::get('index', [EmployeesController::class, 'index'])->name('index');
Route::post('store', [EmployeesController::class, 'store'])->name('store');
