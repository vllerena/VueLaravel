<?php

use App\Http\Controllers\API\Admin\SuppliersController;
use Illuminate\Support\Facades\Route;

Route::get('index', [SuppliersController::class, 'index'])->name('index');
Route::get('show/{supplier}', [SuppliersController::class, 'show'])->name('show');
Route::post('store', [SuppliersController::class, 'store'])->name('store');
Route::patch('update/{supplier}', [SuppliersController::class, 'update'])->name('update');
Route::delete('destroy/{supplier}', [SuppliersController::class, 'destroy'])->name('destroy');
