<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Emprestimo;
use App\Models\Livro;
use App\Models\Usuario;
use Illuminate\Validation\Rule;

class EmprestimoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        # Existe livro_id nas instâncias?
        $usuarios = Usuario::pluck('matricula')->toArray();

        return [
            'usuario' => ['required','integer', Rule::in($usuarios)],
            'titulo'  => 'required',
            'autor'   => 'nullable', 
            'tombo'   => 'nullable|integer', 
        ];
    }
}
