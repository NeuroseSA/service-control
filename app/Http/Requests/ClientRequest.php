<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'cnpj' => 'required',
            'name' => 'required|min:4',
            'fone' => 'required',
            'address' => 'required|min:4',
            'email' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'cnpj.required' => 'O CNJP é obrigatório',
            'name.required' => 'Nome do cliente é obrigatório',
            'fone.required' => 'Contato do cliente é obrigatório',
            'address.required' => 'Endereço do cliente é obrigatório',
            'email.required' => 'E-mail do cliente é obrigatório',
        ];
    }
}
