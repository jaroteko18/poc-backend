<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me', 'me');
});

Route::middleware('auth:api')->controller(CustomerController::class)->group(function () {
    Route::post('customerform/gridconfig', [CustomerController::class, 'gridconfig']);
    Route::post('customerform/formconfig', [CustomerController::class, 'formconfig']);
    Route::post('customerform/gets', [CustomerController::class, 'gets']);
    Route::post('customerform/get', [CustomerController::class, 'get']);
    Route::post('customerform/delete', [CustomerController::class, 'delete']);
    Route::post('customerform/insert', [CustomerController::class, 'insert']);
    Route::post('customerform/update', [CustomerController::class, 'update']);
}); 

