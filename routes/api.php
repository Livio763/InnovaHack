<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MissionController;
use App\Http\Controllers\Api\ProgressController;
use App\Http\Controllers\Api\BadgeController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AssistantController;

// Rutas públicas
Route::post('/register', [AuthController::class, 'register'])->name('api.register');
Route::post('/login', [AuthController::class, 'login'])->name('api.login');

// Rutas de misiones (públicas para ver, autenticadas para interactuar)
Route::get('/missions', [MissionController::class, 'index']);
Route::get('/missions/{id}', [MissionController::class, 'show']);

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Progreso de usuario
    Route::get('/progress', [ProgressController::class, 'index']);
    Route::post('/missions/{mission}/complete', [ProgressController::class, 'complete']);
    Route::patch('/missions/{mission}/status', [ProgressController::class, 'updateStatus']);
    Route::post('/missions/{mission}/submit', [MissionController::class, 'submit']);
    
    // Insignias
    Route::get('/badges', [BadgeController::class, 'index']);
    
    // Usuario
    Route::patch('/me/level', [UserController::class, 'updateLevel']);
    Route::patch('/me/diagnostic', [UserController::class, 'updateDiagnostic']);
    Route::get('/me/stats', [UserController::class, 'stats']);
    
    // Asistente IA
    Route::post('/assistant/chat', [AssistantController::class, 'chat']);
    Route::get('/assistant/greeting', [AssistantController::class, 'greeting']);
});
