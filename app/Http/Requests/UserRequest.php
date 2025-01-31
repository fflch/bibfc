<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'unidade_id' => 'required|integer'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge(['password' => Hash::make($this->password)]);
    }

    public function messages(){
        return [
            'name.required' => 'O campo "Nome" é obrigatório',
            'email.required' => 'O E-mail é obrigatório',
            'email.email' => 'Insira um E-mail válido',
            'email.unique' => 'Este E-mail já está cadastrado',
            'password.required' => 'O campo "Senha" é obrigatório',
            'unidade_id.required' => 'Insira a unidade',
        ];
    }

}
