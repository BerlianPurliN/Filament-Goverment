<?php

use App\Http\Controllers\CityApiController;
use App\Http\Controllers\EmployeeApiController;
use App\Http\Controllers\StateApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryApiController;
use App\Http\Controllers\DepartmentApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('/country', CountryApiController::class);
Route::resource('/state', StateApiController::class);
Route::resource('/city', CityApiController::class);
Route::resource('/department', DepartmentApiController::class);
Route::resource('/employee', EmployeeApiController::class);

