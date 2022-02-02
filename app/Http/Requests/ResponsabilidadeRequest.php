<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Responsabilidade;
use Illuminate\Validation\Rule;

class ResponsabilidadeRequest extends FormRequest
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
            'nome'              => 'required',
            'ano_nascimento'    => 'nullable|integer',
            'ano_falecimento'   => 'nullable|integer',
        ];

        return $rules;
    }

}
