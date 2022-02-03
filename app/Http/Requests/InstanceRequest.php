<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Livro;
use App\Models\Instance;
use Illuminate\Validation\Rule;

class InstanceRequest extends FormRequest
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
        $livros = Livro::pluck('id')->toArray();

        $rules = [
            'tombo_tipo'  => ['required'],
            'notas'       => 'nullable',
            'exemplar'    => 'nullable',
            'notas'       => 'nullable',
            'status'      => ['required', Rule::in(Instance::status)],
            'livro_id'    => ['required','integer', Rule::in($livros)],
        ];
        if ($this->method() == 'PATCH' || $this->method() == 'PUT'){
            $rules['tombo'] = [
                'required',
                'integer',
                 Rule::unique('instances')->where(function ($query) {
                     $query->where('tombo', $this->tombo)
                        ->where('tombo_tipo', $this->tombo_tipo);
                 })->ignore($this->instance->id)
            ];
        } else {
            $rules['tombo'] = [
                'required',
                'integer',
                 Rule::unique('instances')->where(function ($query) {
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
