<?php
namespace App\DTO;

use App\Http\Requests\StoreUpdateContact;

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