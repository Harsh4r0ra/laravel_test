<?php
namespace App\Http\Middleware;

class CompanyContext
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader('Company-Id')) {
            return response()->json([
                'success' => false,
                'message' => 'Company ID is required',
                'statusCode' => '403'
            ], 403);
        }

        return $next($request);
    }
}