<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="StoreUpdateContact",
 *     title="Store Update Contact DTO",
 *     description="DTO for updating a contact",
 *     required={"name", "email", "cpf", "dob", "phone_number"},
 *     @OA\Property(property="name", type="string", description="Name of the contact"),
 *     @OA\Property(property="email", type="string", format="email", description="Email of the contact"),
 *     @OA\Property(property="cpf", type="string", description="CPF of the contact"),
 *     @OA\Property(property="dob", type="string", format="date", description="Date of birth of the contact"),
 *     @OA\Property(property="phone_number", type="array", @OA\Items(type="string", description="Phone numbers of the contact"))
 * )
 */

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
