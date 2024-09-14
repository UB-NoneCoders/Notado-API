<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/roles', [RoleController::class, 'create']);
Route::put('/roles/{role}', [RoleController::class, 'update']);
Route::get('/roles/{role}/users', [RoleController::class, 'getUsers']);