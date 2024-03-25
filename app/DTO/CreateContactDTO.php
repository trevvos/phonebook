<?php

namespace App\DTO;
use App\Http\Requests\StoreUpdateContact;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="CreateContactDTO",
 *     title="Create Contact DTO",
 *     description="Schema for the Create Contact DTO",
 *     @OA\Property(property="name", type="string", description="Name of the contact"),
 *     @OA\Property(property="email", type="string", format="email", description="Email of the contact"),
 *     @OA\Property(property="cpf", type="string", description="CPF of the contact"),
 *     @OA\Property(property="dob", type="string", format="date", description="Date of birth of the contact"),
 *     @OA\Property(property="phone_number", type="array", @OA\Items(type="string", description="Phone numbers of the contact"))
 * )
 */

class CreateContactDTO {

    public function __construct(
        public string $name,
        public string $email,
        public string $cpf,
        public string $dob,
        public array $phone_number
    ){}
    
    public static function makeFromRequest(StoreUpdateContact $request): self{
        return new self(
            $request->name,
            $request->email,
            $request->cpf,
            $request->dob,
            $request->phone_number // Apenas atribui os telefones diretamente
        );
    }
    }
