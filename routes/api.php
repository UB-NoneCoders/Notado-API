<?php


use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rota para autenticação de usuário
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/roles', [RoleController::class, 'create']);
Route::put('/roles/{role}', [RoleController::class, 'update']);
Route::get('/roles/{role}/users', [RoleController::class, 'getUsers']);

Route::middleware('auth:sanctum')->group(function () {
  Route::get('/user/{id}', [AuthController::class, 'getRole']);
  Route::put('/user/{id}', [AuthController::class, 'update']);

});

// Rota para exibir um teste específico pelo ID
Route::get('/tests/{id}', [TestController::class, 'getTest']);

// Rota para armazenar um novo teste
Route::post('/tests', [TestController::class, 'store']);

// Rota para atualizar um teste existente
Route::put('/tests/{test}', [TestController::class, 'update']);

// Rota para remover um teste específico
Route::delete('/tests/{test}', [TestController::class, 'destroy']);
