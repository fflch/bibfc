<?php

namespace App\Exceptions;

use Exception;

class CabecalhoInvalidoException extends Exception
{
    public function render($request){
        return response()->view('errors.cabecalho-invalido',[
            'mensagem' => $this->getMessage(),
        ], 400);
    }
}
