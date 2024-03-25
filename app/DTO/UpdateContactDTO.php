<?php
namespace App\DTO;

use App\Http\Requests\StoreUpdateContact;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="StoreUpdateContactDTO",
 *     title="Store Update Contact DTO",
 *     description="Schema for the Store Update Contact DTO",
 *     @OA\Property(property="id", type="string", description="ID of the contact"),
 *     @OA\Property(property="name", type="string", description="Name of the contact"),
 *     @OA\Property(property="email", type="string", format="email", description="Email of the contact"),
 *     @OA\Property(property="cpf", type="string", description="CPF of the contact"),
 *     @OA\Property(property="dob", type="string", format="date", description="Date of birth of the contact"),
 *     @OA\Property(property="phone_number", type="array", @OA\Items(type="string", description="Phone numbers of the contact"))
 * )
 */

class UpdateContactDTO {

    public function __construct(
        public string $id,
        public string $name,
        public string $email,
        public string $cpf,
        public string $dob,
        public array $phone_number
    ){}

    public static function makeFromRequest(StoreUpdateContact $request, string $id = null ): self{
        return new self(
            $id ?? $request->id,
            $request->name,
            $request->email,
            $request->cpf,
            $request->dob,
            $request->phone_number
        );
    }
}