<?php

namespace App\Http\Controllers\Api;

use App\DTO\CreateContactDTO;
use App\DTO\UpdateContactDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateContact;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Request;
use App\Http\Resources\ContactResource;
use Illuminate\Http\Response;

class PhonebookController extends Controller
{

    public function __construct(protected ContactService $service){}

    public function index()
    {
        $contacts = Contact::paginate();

        return ContactResource::collection($contacts);
    }

    public function store(StoreUpdateContact $request)
    {
        $contact = $this->service->create(
            CreateContactDTO::makeFromRequest($request)
        );

       $contact = Contact::with('phones')->find($contact->id);

        return new ContactResource($contact);
    }

    public function show(string $id)
    {
        if(!$contact = $this->service->findOne($id)){
            return response()->json([
                'error' => 'Not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $contact = Contact::with('phones')->find($contact->id);

        return new ContactResource($contact);
    }

 
    public function update(StoreUpdateContact $request, string $id)
    {
        $contact = $this->service->update(
            UpdateContactDTO::makeFromRequest($request, $id)
        );

        if(!$contact){
            return response()->json([
                'error' => 'Not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $contact = Contact::with('phones')->find($contact->id);

        return new ContactResource($contact);
    }

    public function destroy(string $id)
    {
        if(!$this->service->findOne($id)){
            return response()->json([
                'error' => 'Not found'
            ], Response::HTTP_NOT_FOUND);
        }

        $this->service->delete($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
