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

Route::post('protect', [AuthController::class, 'protect']);
Route::post('reveal', [AuthController::class, 'reveal']);

Route::post('customer/v2/gridconfig', [CustomerController::class, 'gridconfig']);
Route::post('customer/v2/formconfig', [CustomerController::class, 'formconfig']);
Route::post('customer/v2/gets', [CustomerController::class, 'gets']);
Route::post('customer/v2/get', [CustomerController::class, 'get']);
Route::post('customer/v2/delete', [CustomerController::class, 'delete']);
Route::post('customer/v2/insert', [CustomerController::class, 'insert']);
Route::post('customer/v2/update', [CustomerController::class, 'update']);

Route::middleware('auth:api')->controller(CustomerController::class)->group(function () {
    Route::post('customer/v1/gridconfig', [CustomerController::class, 'gridconfig']);
    Route::post('customer/v1/formconfig', [CustomerController::class, 'formconfig']);
    Route::post('customer/v1/gets', [CustomerController::class, 'gets']);
    Route::post('customer/v1/get', [CustomerController::class, 'get']);
    Route::post('customer/v1/delete', [CustomerController::class, 'delete']);
    Route::post('customer/v1/insert', [CustomerController::class, 'insert']);
    Route::post('customer/v1/update', [CustomerController::class, 'update']);
}); 

