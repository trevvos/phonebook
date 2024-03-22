<?php

namespace App\Repositories;

use App\DTO\CreateContactDTO;
use stdClass;

interface ContactRepositoryInterface {

    public function getAll(): array;
    public function findOne(string $id): stdClass|null;
    public function delete(string $id): void;
    public function create(CreateContactDTO $dto): stdClass;
    //public function update(UpdateContactDTO $dto): stdClass|null;

}