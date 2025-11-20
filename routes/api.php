<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;

Route::apiResource('tareas', TareaController::class);
