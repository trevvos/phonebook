<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateContact;

class CreateContactDTO {

    public function __construct(
        public string $name,
        public string $email,
        public string $cpf,
        public string $dob,
        public array $phones = []
    ){}
    
    public static function makeFromRequest(StoreUpdateContact $request): self{
        return new self(
            $request->name,
            $request->email,
            $request->cpf,
            $request->dob,
            $request->phones // Apenas atribui os telefones diretamente
        );
    }
    }
