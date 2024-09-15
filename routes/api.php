<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

// Rotas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rotas protegidas por autenticação
Route::middleware('auth:sanctum')->group(function () {
    // Controller dos Usuários
    Route::get('/users', [AuthController::class, 'index']); // Listar todos os usuários
    Route::post('/logout', [AuthController::class, 'logout']); // Logout
    Route::get('/validate-token', [AuthController::class, 'validateToken']); // Validar token de autenticação
    Route::post('/users/{id}/role', [AuthController::class, 'addRole']); // Adicionar uma função ao usuário
    Route::delete('/users/{id}/role', [AuthController::class, 'removeRole']); // Remover uma função do usuário
    Route::get('/users/{id}/role', [AuthController::class, 'getRole']); // Obter o papel/função do usuário
    Route::put('/users/{id}', [AuthController::class, 'update']); // Atualizar informações do usuário

    // Controller de Funções
    Route::post('/roles', [RoleController::class, 'create']); // Criar um novo Role
    Route::put('/roles/{role}', [RoleController::class, 'update']); // Atualizar um Role existente
    Route::get('/roles/{role}/users', [RoleController::class, 'getUsers']); // Obter todos os usuários associados a um Role

    // Controller de Matérias
    Route::get('/subjects', [SubjectController::class, 'index']); // Listar todas as disciplinas
    Route::post('/subjects', [SubjectController::class, 'store']); // Criar uma nova disciplina
    Route::get('/subjects/{id}', [SubjectController::class, 'show']); // Exibir uma disciplina específica
    Route::put('/subjects/{id}', [SubjectController::class, 'update']); // Atualizar uma disciplina existente
    Route::delete('/subjects/{id}', [SubjectController::class, 'destroy']); // Excluir uma disciplina

    // Controller de Testes
    Route::get('/tests', [TestController::class, 'index']); // Listar todos os testes
    Route::post('/tests', [TestController::class, 'store']); // Criar um novo teste
    Route::get('/tests/{id}', [TestController::class, 'getTest']); // Exibir um teste específico
    Route::put('/tests/{test}', [TestController::class, 'update']); // Atualizar um teste existente
    Route::delete('/tests/{test}', [TestController::class, 'destroy']); // Excluir um teste
});
