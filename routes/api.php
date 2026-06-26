<?php

use App\Http\Controllers\Api\V1\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::middleware('apikey')->group(function () {

    Route::prefix('v1')->group(function () {

        Route::get('/schedules', [ScheduleController::class, 'index']);

        Route::get('/schedules/{id}', [ScheduleController::class, 'show']);

        Route::post('/schedules', [ScheduleController::class, 'store']);

    });

});