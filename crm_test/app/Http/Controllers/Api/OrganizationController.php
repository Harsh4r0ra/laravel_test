<?php
// app/Http/Controllers/Api/OrganizationController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrganizationService;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    protected $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

    public function view(Request $request)
    {
        try {
            $data = $request->has('organizationId')
                ? $this->organizationService->getOrganizationById($request->organizationId)
                : $this->organizationService->searchOrganizations($request->organizationName);

            return response()->json([
                'success' => true,
                'data' => json_encode($data),
                'message' => 'Organizations retrieved successfully',
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
