<?php

use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rota para autenticação de usuário
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Rota para exibir um teste específico pelo ID
Route::get('/tests/{id}', [TestController::class, 'getTest']);

// Rota para armazenar um novo teste
Route::post('/tests', [TestController::class, 'store']);

// Rota para atualizar um teste existente
Route::put('/tests/{test}', [TestController::class, 'update']);

// Rota para remover um teste específico
Route::delete('/tests/{test}', [TestController::class, 'destroy']);
