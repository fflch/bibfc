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
            #'titulo'      => 'required|unique:livros,titulo,'  . $this->titulo,
            'titulo' => [
                'required',
                Rule::unique('livros', 'titulo')->ignore($this->route('livro')),
            ],
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
            'responsabilidade' => 'required|array',
            'responsabilidade.*' => ['required','integer', Rule::exists('responsabilidades','id')],
            'livro_id' => 'integer',
            'tipo' => ['required','array'],
            'tipo.*' => ['required','string',Rule::in(\App\Models\LivroResponsabilidade::tipos)]
        ];

        return $rules;
    }

    
    public function messages(){
        return [
            'titulo.required' => 'O título do livro é obrigatório',
            'titulo.unique' => 'Este livro já está cadastrado no sistema',
            'paginas.integer' => 'Insira um número inteiro nas páginas',
            'localizacao.required' => 'A localização é obrigatória',
            'tipo.*.required' => 'O tipo de autoria é obrigatório',
            'responsabilidade.*.required' => 'Insira pelo menos um autor'
        ];
    }

    public function prepareForValidation(){
        $this->merge([
            'colorido' => $this->input('colorido') === 'sim' ? 'sim' : 'não',
            'ilustrado' => $this->input('ilustrado') === 'sim' ? 'sim' : 'não',
        ]);
    }

}
