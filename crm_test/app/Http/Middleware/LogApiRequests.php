<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LogApiRequests
{
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        $logId = null;

        try {
            // Log incoming request
            $logId = DB::table('api_log')->insertGetId([
                'method' => $request->method(),
                'url' => $request->fullUrl(),
                'payload' => json_encode($request->all()),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'company_id' => $request->header('Company-Id'),
                'created_at' => now()
            ]);

            $response = $next($request);

            // Calculate duration
            $duration = microtime(true) - $startTime;

            // Log response
            if ($logId) {
                DB::table('api_log')
                    ->where('id', $logId)
                    ->update([
                        'response_code' => $response->status(),
                        'response' => $response->getContent(),
                        'duration' => $duration,
                        'updated_at' => now()
                    ]);
            }

            return $response;

        } catch (\Exception $e) {
            // Log error if we have a log ID
            if ($logId) {
                DB::table('api_log')
                    ->where('id', $logId)
                    ->update([
                        'response_code' => 500,
                        'response' => json_encode([
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString()
                        ]),
                        'duration' => microtime(true) - $startTime,
                        'updated_at' => now()
                    ]);
            }

            throw $e;
        }
    }
}