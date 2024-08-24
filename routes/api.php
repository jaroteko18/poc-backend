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
    Route::get('customers', 'index');
    Route::post('customer', 'store');
    Route::get('customer/{id}', 'show');
    Route::post('customer/{id}', 'update');
    Route::delete('customer/{id}', 'destroy');
}); 