<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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

    public function rules(){
        $rules = [
            'nome'      => 'required',
            'matricula' => ['required','integer'],
            'telefone'  => 'nullable',
            'turma'     => 'nullable',
            'setor'     => 'nullable',
            'foto'      => 'nullable',
            'obs'       => 'nullable',
        ];
        if ($this->method() == 'PATCH' || $this->method() == 'PUT'){
            array_push($rules['matricula'], 'unique:usuarios,matricula,' .$this->usuario->id);
        }
        else{
            array_push($rules['matricula'], 'unique:usuarios');
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'nome.required' => 'O nome é obrigatório',
        ];
    }
}
