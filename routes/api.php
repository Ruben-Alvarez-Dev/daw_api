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
Route::get('/units/{id}', function () {
    return "get unit by ID";
});
Route::post('/units', function () {
    return "post units";
});
Route::put('/units/{id}', function () {
    return "put unit by ID";
});
Route::patch('/units/{id}', function () {
    return "patch unit by ID";
});
Route::delete('/units/{id}', function () {
    return "delete unit by ID";
});

// All routes fot USERS
//================================================
Route::get('/users', function () {
    return "get all users";
});
Route::get('/users/{id}', function () {
    return "get user by ID";
});
Route::post('/users', function () {
    return "post users";
});
Route::put('/users/{id}', function () {
    return "put user by ID";
});
Route::patch('/users/{id}', function () {
    return "patch user by ID";
});
Route::delete('/users/{id}', function () {
    return "delete user by ID";
});

// All routes fot TABLES
//================================================
Route::get('/tables', function () {
    return "get all tables";
});
Route::get('/tables/{id}', function () {
    return "get table by ID";
});
Route::post('/tables', function () {
    return "post tables";
});
Route::put('/tables/{id}', function () {
    return "put table by ID";
});
Route::patch('/tables/{id}', function () {
    return "patch table by ID";
});
Route::delete('/tables/{id}', function () {
    return "delete table by ID";
});

// All routes fot RESERVATIONS
//================================================
Route::get('/reservations', function () {
    return "get all reservations";
});
Route::get('/reservations/{id}', function () {
    return "get reservation by ID";
});
Route::post('/reservations', function () {
    return "post reservations";
});
Route::put('/reservations/{id}', function () {
    return "put reservation by ID";
});
Route::patch('/reservations/{id}', function () {
    return "patch reservation by ID";
});
Route::delete('/reservations/{id}', function () {
    return "delete reservation by ID";
});

