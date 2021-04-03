<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'cpf' => 'required',
            'name' => 'required|min:4',
            'fone' => 'required',
            'password' => 'required|min:4',
            'email' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'cpf.required' => 'O CPF é obrigatório',
            'name.required' => 'Nome é obrigatório',
            'fone.required' => 'Contato é obrigatório',
            'password.required' => 'A senha é obrigatório',
            'email.required' => 'E-mail é obrigatório',
        ];
    }
}
