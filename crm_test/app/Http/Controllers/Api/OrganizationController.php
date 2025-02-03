<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrganizationService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
            if (!$request->header('Company-Id')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Company ID is required',
                    'statusCode' => '403'
                ], 403);
            }

            if (!$request->has('organizationId') && !$request->has('organizationName')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Organization ID or name is required',
                    'statusCode' => '400'
                ], 400);
            }

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