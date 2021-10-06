<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Emprestimo;
use App\Models\Livro;
use App\Rules\checkIfIsAvailable;
use Illuminate\Validation\Rule;

class EmprestimoRequest extends FormRequest
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
        # Existe livro_id nas instâncias?
        $livro = Instance::where('id',$this->livro_id)->pluck('id')->toArray();

        return [
            'livro_id'     => ['required','integer', new checkIfIsAvailable(), Rule::in($livro)],
            'n_usp'           => 'required|integer|codpes', 
        ];
    }
}
