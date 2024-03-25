<?php

namespace App\Schemas;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="ContactResource",
 *     title="Contact Resource",
 *     description="Schema for the Contact resource",
 *     @OA\Property(property="id", type="integer", description="ID of the contact"),
 *     @OA\Property(property="name", type="string", description="Name of the contact"),
 *     @OA\Property(property="email", type="string", format="email", description="Email of the contact"),
 *     @OA\Property(property="cpf", type="string", description="CPF of the contact"),
 *     @OA\Property(property="dob", type="string", format="date", description="Date of birth of the contact"),
 *     @OA\Property(property="phone_numbers", type="array", @OA\Items(type="string", description="Phone numbers of the contact"))
 * )
 */
class ContactSchema
{
    // Nenhum código adicional é necessário aqui
}
