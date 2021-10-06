<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LivroController;

Route::get('/livros/{livro}', [LivroController::class,'show']);
