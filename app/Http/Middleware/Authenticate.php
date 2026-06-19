<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $guard = $guards[0] ?? null;

        // API Requests (Sanctum)
        if ($request->wantsJson() || $request->is('api/*')) {
            if (! Auth::guard('sanctum')->check()) {
                return response()->json(['message' => 'Authentication token required'], 401);
            }

            return $next($request);
        }

        // Web Requests
        if (! Auth::guard($guard)->check()) {
            if ($guard == 'admin') {
                $guard = 'manager';
            }

            return redirect()->route("{$guard}.login");
        }

        return $next($request);
    }
}
