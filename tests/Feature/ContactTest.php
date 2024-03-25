<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Contact;

class ContactTest extends TestCase
{
    use RefreshDatabase; 
    
    /**
     * Testa o cadastro de um novo contato.
     *
     * @return void
     */
    public function testCreateContact()
    {
  
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            "dob" => "1990-11-05",
            "cpf" => "12345678910",
            "phone_number" => [
                "11 9999-1230",
                "22 9999-4566"
              ]
        ];

        $response = $this->postJson('/api/contacts', $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('contacts', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            "dob" => "1990-11-05",
            "cpf" => "12345678910"
        ]);

        $contact = Contact::where('email', 'john@example.com')->first();

        foreach ($data['phone_number'] as $phone_number) {
            $this->assertDatabaseHas('phones', [
                'contact_id' => $contact->id,
                'phone_number' => $phone_number
            ]);
        }
    }
}
