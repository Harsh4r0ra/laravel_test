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

    public function view(Request $request)
    {
        try {
            $data = $request->has('contactId') 
                ? $this->contactService->getContactById($request->contactId)
                : $this->contactService->searchContacts($request->contactName);

            return response()->json([
                'success' => true,
                'data' => json_encode($data),
                'message' => 'Contacts retrieved successfully',
                'statusCode' => '200',
                'pageable' => ''
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'statusCode' => '500'
            ]);
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