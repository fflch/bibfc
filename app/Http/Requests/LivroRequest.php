<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Livro;

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
            'titulo'       => 'required',
            'tombo_antigo' => 'nullable|integer',
            'unidade' => 'nullable',
            'autor' => 'nullable',
            'editora' => 'nullable',
            'local' => 'nullable',
            'ano' => 'nullable|integer',
            'edicao' => 'nullable',
            'volume' => 'nullable',
            'exemplar' => 'nullable|integer',
            'tombo'       => ['nullable','integer'],
            'localizacao' => ['nullable'],
        ];
        if ($this->method() == 'PATCH' || $this->method() == 'PUT'){
            array_push($rules['tombo'], 'unique:livros,tombo,' .$this->livro->id);
            array_push($rules['localizacao'], 'unique:livros,localizacao,' .$this->livro->id);
        }
        else{
            array_push($rules['tombo'], 'unique:livros');
            array_push($rules['localizacao'], 'unique:livros');
        }

        return $rules;
    }

}
