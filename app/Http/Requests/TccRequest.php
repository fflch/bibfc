<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Livro;
use Illuminate\Validation\Rule;

class TccRequest extends FormRequest
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
            'titulo'       => 'required',
            'autores'      => 'required',
            'orientador'   => 'required',
            'coorientador' => 'required',
            'curso'        => 'required',
            'ano'          => 'required',
            'localizacao'  => 'required',
            'resumo'       => 'required',
            'extensao'     => 'nullable',
        ];

        return $rules;
    }
}
