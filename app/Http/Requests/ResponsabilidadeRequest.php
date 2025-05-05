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
            'nome' => 'required',
            'prenome' => 'nullable',
            'ano_nascimento'    => 'nullable|integer',
            'ano_falecimento'   => 'nullable|integer',
        ];
        
        return $rules;
    }

    public function messages(){
        return [
            'nome.required' => 'O prenome é obrigatório.',
            'ano_nascimento' => 'O ano de nascimento deve ser um número inteiro',
            'ano_falecimento' => 'O ano de falecimento deve ser um número inteiro'
        ];
    }

    /**
     * Get the validated data with the full name.
     *
     * @return array
     */

    public function validationNome(){
        
        $nome = $this->get('nome');
        $sobrenome = $this->get('sobrenome');
        $nomesToArray = [$nome, $sobrenome];
        $nomeCompleto['nome'] = $nomesToArray[0] . $nomesToArray[1];
        return $nomeCompleto;
    }

}
