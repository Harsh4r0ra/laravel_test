<?php
// app/Http/Middleware/LogApiRequests.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class LogApiRequests
{
    public function handle(Request $request, Closure $next)
    {
        // Start timing the request
        $startTime = microtime(true);

        // Log incoming request
        DB::table('api_log')->insert([
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'payload' => json_encode($request->all()),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'company_id' => $request->header('Company-Id', 1),
            'created_at' => now()
        ]);

        $response = $next($request);

        // Calculate request duration
        $duration = microtime(true) - $startTime;

        // Log response
        DB::table('api_log')->where('url', $request->fullUrl())
            ->update([
                'response_code' => $response->status(),
                'response' => json_encode($response->getContent()),
                'duration' => $duration,
                'updated_at' => now()
            ]);

        return $response;
    }
}