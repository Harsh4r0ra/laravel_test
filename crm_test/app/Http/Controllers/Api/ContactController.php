<?php
// app/Http/Controllers/Api/ContactController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    public function searchContacts($searchTerm)
{
    return Contact::with(['phones', 'emails', 'organization'])
        ->where(function ($query) use ($searchTerm) {
            $query->where('first_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('last_name', 'LIKE', "%{$searchTerm}%");
        })
        ->get();
}

    public function view(Request $request)
    {
        try {
            if (!$request->has('contactId') && !$request->has('searchTerm')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Contact ID or search term is required',
                    'statusCode' => '400'
                ], 400);
            }

            $data = $request->has('contactId')
                ? $this->contactService->getContactById($request->contactId)
                : $this->contactService->searchContacts($request->searchTerm);

            return response()->json([
                'success' => true,
                'data' => json_encode($data),
                'message' => 'Contacts retrieved successfully',
                'statusCode' => '200',
                'pageable' => ''
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'statusCode' => '404'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'statusCode' => '500'
            ], 500);
        }
    }
}

// app/Services/ContactService.php
namespace App\Services;

use App\Models\Contact;

class ContactService
{
    public function getContactById($contactId)
    {
        return Contact::with([
            'phones',
            'emails',
            'organization'
        ])->findOrFail($contactId);
    }

    public function searchContacts($searchTerm)
    {
        return Contact::with([
            'phones',
            'emails',
            'organization'
        ])
        ->where('first_name', 'LIKE', "%{$searchTerm}%")
        ->orWhere('last_name', 'LIKE', "%{$searchTerm}%")
        ->get();
    }
}

// Additional controllers and services follow same pattern...