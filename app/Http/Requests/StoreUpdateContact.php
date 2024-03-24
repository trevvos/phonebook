<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateContact extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        
            $rules = [
                'name' => [
                    'required',
                    'min:3',
                    'max:255'
                ],
                'email' => [
                    'required',
                    'email',
                    'unique:contacts'
                ],
                'cpf' => [
                    'required',
                    'unique:contacts',
                    'max:11'
                ],
                'phone_number' => [
                    'required',
                    'unique:phones'
                ]
            ];

            if($this->method() === 'PUT' || $this->method() === 'PATCH'){
                $rules = [
                    'name' => [
                        'min:3',
                        'max:255'
                    ],
                    'cpf' => [
                        'max:11'
                    ],
                    'email' => [
                        'email'
                    ],
                    'phone_number' => [
                        'required'
                    ]
                ];
            }

            return $rules;
    }
}
