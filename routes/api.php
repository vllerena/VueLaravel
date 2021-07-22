<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\Admin\EmployeesController;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

//Route::apiResource('/employee', 'API\Admin\EmployeesController');

Route::group(['middleware' => 'api', 'prefix' => 'admin', 'name' => 'admin'], function () {
    $routesPath = "routes/api/admin";
    Route::prefix("/employees")->name("employees.")
        ->group(base_path("{$routesPath}/employees_routes.php"));
    Route::prefix("/suppliers")->name("suppliers.")
        ->group(base_path("{$routesPath}/suppliers_routes.php"));
});
