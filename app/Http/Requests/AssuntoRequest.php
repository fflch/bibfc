<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Assunto;
use Illuminate\Validation\Rule;

class AssuntoRequest extends FormRequest
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
        $assuntos = Assunto::pluck('id')->toArray();
        $rules =  [
            'titulo' => 'required',
            'parent_id' => ['nullable',Rule::in($assuntos)]
        ];

        if ($this->method() == 'PATCH' || $this->method() == 'PUT'){
            array_push($rules['parent_id'], 'not_in:'. $this->assunto->id);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'parent_id.not_in' => 'Um descritor não pode ser termo geral (TG) dele mesmo',
        ];
    }
}
