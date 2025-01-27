<?php

use App\Http\Controllers\RoverController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RoverController::class, 'index']);

Route::post('/rover/movement',[RoverController::class, 'proceedMovement']);
