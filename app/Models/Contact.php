<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $fillable = [
        'name',
        'email',
        'cpf',
        'dob',
    ];
    // Relacionamento com os telefones
    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
}

