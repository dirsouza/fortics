<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessionRequest extends FormRequest
{
    use ResponseRequest;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'                  => 'required',
            'platform_type'         => 'required',
            'contact_identifier'    => 'required',
            'message'               => 'required'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name'                  => 'Nome',
            'platform_type'         => 'Plataforma',
            'contact_identifier'    => 'Identificador',
            'message'               => 'Mensagem'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'required'  => 'O campo :attribute é obrigatório'
        ];
    }
}
