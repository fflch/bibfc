<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\ResponsabilidadeController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\LivroResponsabilidadeController;
use App\Http\Controllers\InstanceController;

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

Route::resource('/instances', InstanceController::class);
Route::resource('/livros', LivroController::class);
Route::resource('/responsabilidades', ResponsabilidadeController::class);

Route::get('/json_emprestimos_ativos/{matricula}', [EmprestimoController::class, 'json_emprestimos_ativos']);

Route::get('/etiquetas', [PdfController::class, 'etiquetas']);
Route::get('/bolso/{livro}', [PdfController::class, 'bolso']);


Route::delete('/livro_responsabilidades/{pivot}', [LivroResponsabilidadeController::class, 'destroy']);

