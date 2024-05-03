<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controlador;

// Ruta para mostrar el formulario de inicio de sesión (GET)
Route::get('/', function () {
    return view('login');
});

Route::get('/', [Controlador::class, 'index']);
Route::post('/login', [Controlador::class, 'login']);
Route::get('/registro', [Controlador::class, 'mostrarFormularioRegistro'])->name('registro');
Route::post('/registro', [Controlador::class, 'registrar'])->name('registro');
Route::get('/listado', [Controlador::class, 'listado'])->name('listado');
