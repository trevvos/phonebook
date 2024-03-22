<?php

namespace App\Repositories;

use App\Repositories\ContactRepositoryInterface;
use App\DTO\CreateContactDTO;
use App\Models\Contact;

use stdClass;

class ContactEloquentORM implements ContactRepositoryInterface {

    public function __construct(protected Contact $model){}
    
    public function getAll(): array {
        return $this->model->all()->toArray();
    }

    public function findOne(string $id): stdClass|null {
        $support = $this->model->find($id);

        if(!$support){
            return null;
        }

        return (object) $support->toArray();
    }

    public function delete(string $id): void {
        $this->model->findOrFail($id)->delete();
    }

    /*public function update(UpdateContactDTO $dto): stdClass|null {
        if(!$support = $this->model->find($dto->id)){
            return null;
        }

        $support->update((array) $dto);

        return (object) $support->toArray();
    }
    */

    public function create(CreateContactDTO $dto): stdClass {
        $support = $this->model->create((array) $dto);

        return (object) $support->toArray();
    }
}