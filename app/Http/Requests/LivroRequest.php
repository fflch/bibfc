<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Livro;
use Illuminate\Validation\Rule;

class LivroRequest extends FormRequest
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
        $rules = [
            'titulo'      => 'required',
            'subtitulo'   => 'nullable',
            'editora'     => 'nullable',
            'local'       => 'nullable', //local de publicação
            'ano'         => 'nullable',
            'edicao'      => 'nullable',
            'volume'      => 'nullable',
            'localizacao' => 'required', //localizacao na estante
            'complemento_localizacao' => 'nullable',
            'obs'         => 'nullable',
            'isbn'        => 'nullable',
            'extensao'    => 'nullable',
            'dimensao'    => 'nullable',
            'ilustrado'   => 'nullable',
            'colorido'    => 'nullable',
            'colecao'     => 'nullable', #colecao/serie
            'idioma' => 'nullable',
            'paginas' => 'nullable|integer',
            'responsabilidade' => 'required',
        ];

        return $rules;
    }

}
