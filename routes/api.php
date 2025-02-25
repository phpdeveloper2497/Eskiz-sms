<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::post('login', [AuthController::class, 'login']);

Route::controller(AuthController::class)->group(function () {
    Route::post('logout', 'logout');
    Route::get('me', 'me');
})->middleware(['auth:sanctum']);

Route::controller(ApplicationController::class)->prefix('applications')->group(function () {
    Route::get('/', 'index');
    Route::post('/{application}/update-status', 'updateStatus');
    Route::get('/{application}', 'show');
});

Route::controller(UserController::class)->prefix('users')->group(function () {
    Route::get('/', 'index');
    Route::post('/create', 'store');
    Route::get('/{user}', 'userApplications');
    Route::post('/{user}', 'show');
    Route::put('/{user}/update', 'update');
})->middleware(['auth:sanctum']);

Route::controller(StatusController::class)->prefix('statuses')->group(function () {
    Route::get('/', 'index');
})->middleware(['auth:sanctum']);
