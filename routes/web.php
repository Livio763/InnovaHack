<?php

use Illuminate\Support\Facades\Route;

// Redirección inicial - Welcome (página de inicio con registro)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas de autenticación
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

// Flujo de onboarding
Route::get('/classification', function () {
    return view('classification');
})->name('classification');

Route::get('/evaluation-pending', function () {
    return view('evaluation-pending');
})->name('evaluation-pending');

Route::get('/route', function () {
    return view('route');
})->name('route');

Route::get('/diagnostic', function () {
    return view('diagnostic');
})->name('diagnostic');

// Vistas principales (públicas en MVP; autenticación se maneja vía API tokens)
Route::get('/modules', function () {
    return view('modules');
})->name('modules');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/mission/{id}', function ($id) {
    return view('mission', ['missionId' => $id]);
})->name('mission');

// Vista de éxito/confirmación
Route::get('/success', function () {
    return view('success');
})->name('success');
