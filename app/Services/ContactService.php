<?php

namespace App\Services;

use App\DTO\CreateContactDTO;
use App\Repositories\ContactRepositoryInterface;
use App\Models\Phone;
use stdClass;

class ContactService 
{
    public function __construct(protected ContactRepositoryInterface $repository){}

    public function getAll(): array
    {
        return $this->repository->getAll();
    }

    public function findOne(string $id): stdClass|null 
    {
        return $this->repository->findOne($id);
    }

    public function create(CreateContactDTO $dto): stdClass{
        $contact = $this->repository->create($dto);

        // Criação dos números de telefone associados ao contato
        foreach ($dto->phones as $phoneNumber) {
            Phone::create([
                'contact_id' => $contact->id,
                'phone_number' => $phoneNumber,
            ]);
        }

        return $contact;
    }

    /*public function update(UpdateContactDTO $dto): stdClass|null {
        return $this->repository->update($dto);
    }
    */

    public function delete(string $id): void {
        $this->repository->delete($id);
    }

}