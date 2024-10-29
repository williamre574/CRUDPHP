<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;
Route::get('/', [CrudController::class, 'index'])->name('crud.index');

Route::post('/registro', [CrudController::class, 'registro'])->name('crud.registro');

Route::post('/productos/{id}', [CrudController::class, 'modificar'])->name('crud.modificar');

Route::delete('/productos/{id}', [CrudController::class, 'destroy'])->name('crud.eliminar');

