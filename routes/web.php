<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommissionController;
use App\Http\Controllers\PaymentController;

Route::get('/', [CommissionController::class, 'index']);
Route::apiResource('payments', PaymentController::class);
