<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\EventApiController;

Route::get('/events', [EventApiController::class, 'index']);
