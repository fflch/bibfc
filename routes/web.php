<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\EtiquetaController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::resource('/usuarios', UsuarioController::class);
Route::get('/foto/{matricula}', [UsuarioController::class,'foto']);
Route::get('/temfoto/{matricula}', [UsuarioController::class,'temfoto']);

Route::resource('/emprestimos', EmprestimoController::class);
Route::get('/renovar/{emprestimo}', [EmprestimoController::class,'renovarForm']);
Route::post('/renovar/{emprestimo}', [EmprestimoController::class,'renovar']);

Route::get('/confirm/{usuario}/{livro}', [EmprestimoController::class,'confirmForm']);
Route::post('/confirm/{usuario}/{livro}', [EmprestimoController::class,'confirm']);

Route::resource('/livros', LivroController::class);

Route::get('/etiquetas', [EtiquetaController::class, 'etiquetas']);
