<?php

namespace App\Http\Middleware;

use App\Services\MasterLogger;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogMasterActivity
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (! MasterLogger::shouldSkip($request)) {
            MasterLogger::fromRequest($request, $response->getStatusCode());
        }

        return $response;
    }
}
