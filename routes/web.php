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
use App\Http\Controllers\AssuntoController;
use App\Http\Controllers\LivroAssuntoController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TccController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\UserController;

//Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index']);
Route::get('/home',[HomeController::class, 'index'])->name('home');


Route::get('/registrar', [UserController::class, 'registrar']);
Route::post('/store', [UserController::class, 'store']);

Route::get('/login', [UserController::class, 'index']);
Route::post('/login', [UserController::class, 'auth']);
Route::post('/logout', [UserController::class, 'logout']);

Route::resource('/usuarios', UsuarioController::class);
Route::get('/temfoto/{matricula}', [UsuarioController::class,'temfoto']);
Route::get('/foto/{matricula}', [UsuarioController::class,'foto']);

Route::resource('/emprestimos', EmprestimoController::class);
Route::get('/renovar/{emprestimo}', [EmprestimoController::class,'renovarForm']);
Route::post('/renovar/{emprestimo}', [EmprestimoController::class,'renovar']);

Route::resource('/instances', InstanceController::class);
Route::resource('/livros', LivroController::class);

Route::get('/mesclar', [LivroController::class,'mesclar']);
Route::post('/mesclar', [LivroController::class,'mesclarStore']);
Route::get('/pre', [LivroController::class,'pre']);

Route::post('/pre/{livro}', [LivroController::class, 'status']); //aprova ou reprova
Route::put('/pre/aprovar_todos', [LivroController::class, 'aprovar_todos']);

Route::resource('/responsabilidades', ResponsabilidadeController::class);
Route::resource('/assuntos', AssuntoController::class);

Route::get('/json_emprestimos_ativos/{matricula}', [EmprestimoController::class, 'json_emprestimos_ativos']);

Route::get('/etiquetas', [PdfController::class, 'etiquetas']);
Route::get('/bolso/{livro}', [PdfController::class, 'bolso']);

Route::get('/livro_responsabilidades/{livro}', [LivroResponsabilidadeController::class, 'create']);
Route::post('/livro_responsabilidades/{livro}', [LivroResponsabilidadeController::class, 'store']);
Route::delete('/livro_responsabilidades/{pivot}', [LivroResponsabilidadeController::class, 'destroy']);

Route::get('/livro_assuntos/{livro}', [LivroAssuntoController::class, 'create']);
Route::post('/livro_assuntos/{livro}', [LivroAssuntoController::class, 'store']);
Route::delete('/livro_assuntos/{pivot}', [LivroAssuntoController::class, 'destroy']);

Route::get('/reports', [ReportController::class, 'index']);
Route::get('/audit', [AuditController::class, 'audit']);

Route::resource('files', FileController::class);

Route::get('instances', [ExportController::class,'instances']);
Route::get('adolescentes', [ExportController::class, 'exportAdolescentes']);
Route::post('adolescentes/import', [ExportController::class, 'importAdolescentes']);
Route::get('/download', [ExportController::class, 'download']);

Route::get('/barcode/step1', [BarcodeController::class, 'step1']);
Route::post('/barcode/step2', [BarcodeController::class, 'step2']);
Route::get('/barcode/step3', [BarcodeController::class, 'step3']);
Route::post('/barcode/step4', [BarcodeController::class, 'step4']);

Route::get('/barcode/tombo', [BarcodeController::class, 'tombo']);
Route::post('/barcode/tombo', [BarcodeController::class, 'tombo_store']);

Route::get('/barcode/emprestar', [BarcodeController::class, 'emprestar']);
Route::post('/barcode/emprestar', [BarcodeController::class, 'emprestar_store']);