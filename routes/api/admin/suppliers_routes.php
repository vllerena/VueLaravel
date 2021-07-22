<?php

use App\Http\Controllers\API\Admin\SuppliersController;
use Illuminate\Support\Facades\Route;

Route::get('index', [SuppliersController::class, 'index'])->name('index');
Route::get('show/{employee}', [SuppliersController::class, 'show'])->name('show');
Route::post('store', [SuppliersController::class, 'store'])->name('store');
Route::patch('update/{employee}', [SuppliersController::class, 'update'])->name('update');
Route::delete('destroy/{employee}', [SuppliersController::class, 'destroy'])->name('destroy');
