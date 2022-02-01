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
            'editora'     => 'nullable',
            'local'       => 'nullable',
            'ano'         => 'nullable',
            'edicao'      => 'nullable',
            'volume'      => 'nullable',
            'localizacao' => 'nullable',
            'complemento_localizacao' => 'nullable',
            'obs'         => 'nullable',
        ];

        return $rules;
    }

}
