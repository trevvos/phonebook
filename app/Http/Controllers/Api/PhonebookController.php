<?php 

namespace App\Http\Controllers\Api;
use App\Http\Resources\ContactResource;
use OpenApi\Annotations as OA;
use App\DTO\CreateContactDTO;
use App\DTO\UpdateContactDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateContact;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Response;

/**
 * @OA\Info(
 *     title="API de Contatos",
 *     version="1.0.0",
 *     description="Documentação da API de Contatos"
 * )
 */

class PhonebookController extends Controller
{

    public function __construct(protected ContactService $service){}

    public function report()
    {
        $contacts = $this->service->getAll();

        $contactNames = array_column($contacts, 'name');

        return response()->json($contactNames);
    }

    /**
 * Display a listing of the resource.
 *
 * @OA\Get(
 *     path="/api/contacts",
 *     summary="Get all contacts",
 *     tags={"Contacts"},
 *     @OA\Response(
 *         response=200,
 *         description="List of contacts",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/ContactResource")
 *         )
 *     ),
 * )
 */
    public function index()
    {
        $contacts = Contact::paginate();

        return ContactResource::collection($contacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *     path="/api/contacts",
     *     summary="Create a new contact",
     *     tags={"Contacts"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateContactDTO")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Contact created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/ContactResource")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *     )
     * )
     */
    public function store(StoreUpdateContact $request)
    {
        $contact = $this->service->create(
            CreateContactDTO::makeFromRequest($request)
        );

        $contact = Contact::with('phones')->find($contact->id);

        return new ContactResource($contact);
    }

    /**
     * Display the specified resource.
     *
     * @OA\Get(
     *     path="/api/contacts/{id}",
     *     summary="Get a contact by ID",
     *     tags={"Contacts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the contact",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Contact details",
     *         @OA\JsonContent(ref="#/components/schemas/ContactResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Contact not found",
     *     )
     * )
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @OA\Put(
     *     path="/api/contacts/{id}",
     *     summary="Update a contact by ID",
     *     tags={"Contacts"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the contact",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreUpdateContact")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Contact updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/ContactResource")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Contact not found",
     *     )
     * )
     */
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

    /**
 * Remove the specified resource from storage.
 *
 * @OA\Delete(
 *     path="/api/contacts/{id}",
 *     summary="Delete a contact",
 *     tags={"Contacts"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the contact",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=204,
 *         description="Contact deleted successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Contact not found",
 *     )
 * )
 */


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