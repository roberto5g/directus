<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoExperienciaProfissionalRequest extends FormRequest
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

        return [
            'descricao' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => 'O campo "Descrição do Tipo de Experiência Profissional" não pode ser vazio.',
        ];
    }
}
