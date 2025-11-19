<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;

Route::get("/contactos", [ContactoController::class, "index"]);
Route::post("/contactos", [ContactoController::class, "store"]);
Route::get("/contactos/{id}", [ContactoController::class, "show"]);
Route::put("/contactos/{id}", [ContactoController::class, "update"]);
Route::delete("/contactos/{id}", [ContactoController::class, "destroy"]);
