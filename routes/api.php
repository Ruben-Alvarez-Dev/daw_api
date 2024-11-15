<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\unitController;
use App\Http\Controllers\API\userController;
use App\Http\Controllers\API\tableController;
use App\Http\Controllers\API\reservationController;

// All routes fot UNITS
//================================================
Route::get('/units', [unitController::class, 'index']);
Route::get('/units/{id}', [unitController::class, 'show']);
Route::post('/units', [unitController::class, 'store']);
Route::put('/units/{id}', [unitController::class, 'update']);
Route::delete('/units/{id}', [unitController::class, 'destroy']);

// All routes fot USERS
//================================================
Route::get('/users', [userController::class, 'index']);
Route::get('/users/{id}', [userController::class, 'show']);
Route::post('/users', [userController::class, 'store']);
Route::put('/users/{id}', [userController::class, 'update']);
Route::delete('/users/{id}', [userController::class, 'destroy']);

// All routes fot TABLES
//================================================
Route::get('/tables', [tableController::class, 'index']);
Route::get('/tables/{id}', [tableController::class, 'show']);
Route::post('/tables', [tableController::class, 'store']);
Route::put('/tables/{id}', [tableController::class, 'update']);
Route::delete('/tables/{id}', [tableController::class, 'destroy']);

// All routes fot RESERVATIONS
//================================================
Route::get('/reservations', [reservationController::class, 'index']);
Route::get('/reservations/{id}', [reservationController::class, 'show']);
Route::post('/reservations', [reservationController::class, 'store']);
Route::put('/reservations/{id}', [reservationController::class, 'update']);
Route::delete('/reservations/{id}', [reservationController::class, 'destroy']);
