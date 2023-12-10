<?php
use App\Http\Controllers\VueController;

use Illuminate\Support\Facades\Route;


Route::get('/', [VueController::class, 'render']);





Route::get('/films/list', [VueController::class, 'render']);
Route::get('/films/create', [VueController::class, 'render']);
Route::get('/films/{id}/edit', [VueController::class, 'render']);
Route::get('/films/show/{id}', [VueController::class, 'render']);

