<?php

namespace App\Http\Controllers\Api;

use App\DTO\CreateContactDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateContact;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Request;

class PhonebookController extends Controller
{

    public function __construct(protected ContactService $service){}

    public function index()
    {
        $contacts = Contact::all();

        dd($contacts);
    }

    public function store(StoreUpdateContact $request)
    {
        $contact = $this->service->create(
            CreateContactDTO::makeFromRequest($request)
        );

        return $contact;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
