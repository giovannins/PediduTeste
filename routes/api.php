<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\LocalidadesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('item', ItemController::class);

Route::get('/localidades', [LocalidadesController::class, 'index']);
Route::get('/localidades/{id}', [LocalidadesController::class, 'show']);
Route::post('/localidades/ibge_update', [LocalidadesController::class, 'ibgeUpdate']);