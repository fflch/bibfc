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
            'tombo_tipo'  => ['required'],
            'autor'       => 'nullable',
            'editora'     => 'nullable',
            'local'       => 'nullable',
            'ano'         => 'nullable',
            'edicao'      => 'nullable',
            'volume'      => 'nullable',
            'localizacao' => 'nullable',
            'complemento_localizacao' => 'nullable',
            'obs'         => 'nullable',
        ];
        if ($this->method() == 'PATCH' || $this->method() == 'PUT'){
            $rules['tombo'] = [
                'required',
                'integer',
                 Rule::unique('livros')->where(function ($query) {
                     $query->where('tombo', $this->tombo)
                        ->where('tombo_tipo', $this->tombo_tipo);
                 })->ignore($this->livro->id)
            ];
        } else {
            $rules['tombo'] = [
                'required',
                'integer',
                 Rule::unique('livros')->where(function ($query) {
                     $query->where('tombo', $this->tombo)
                        ->where('tombo_tipo', $this->tombo_tipo);
                 })
            ];
            
        }

        return $rules;
    }

    public function messages() {
        return [
           'tombo.unique' => 'Esse tombo para essa categoria está em uso!',
        ];
    }

}
