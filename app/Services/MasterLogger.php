<?php

namespace App\Services;

use App\Models\MasterLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class MasterLogger
{
    protected static array $sensitiveKeys = [
        'password',
        'password_confirmation',
        'current_password',
        'token',
        'api_token',
        'access_token',
        'refresh_token',
        'secret',
        'api_secret',
        'authorization',
        'otp',
        'pin',
        'cvv',
        'card_number',
        'credit_card',
        '_token',
    ];

    public static function log(array $attributes = []): ?MasterLog
    {
        try {
            $request = request();
            $actor = self::resolveActor($request);

            $payload = array_merge([
                'actor_type' => $actor['type'],
                'actor_id' => $actor['id'],
                'actor_name' => $actor['name'],
                'actor_role' => $actor['role'],
                'source' => self::resolveSource($request),
                'action' => null,
                'module' => null,
                'description' => null,
                'method' => $request?->method(),
                'route_name' => optional($request?->route())->getName(),
                'url' => $request?->fullUrl(),
                'ip_address' => $request?->ip(),
                'user_agent' => $request?->userAgent(),
                'response_status' => null,
                'request_data' => null,
                'properties' => null,
            ], $attributes);

            if ($payload['description'] === null) {
                $payload['description'] = self::buildDescription($payload);
            }

            return MasterLog::create($payload);
        } catch (Throwable $e) {
            Log::warning('MasterLogger failed: '.$e->getMessage());

            return null;
        }
    }

    public static function fromRequest(Request $request, ?int $responseStatus = null, array $extra = []): ?MasterLog
    {
        $routeName = optional($request->route())->getName();
        $path = '/'.ltrim($request->path(), '/');

        return self::log(array_merge([
            'action' => self::guessAction($request),
            'module' => self::guessModule($routeName, $path),
            'description' => self::buildRequestDescription($request, $routeName, $path),
            'method' => $request->method(),
            'route_name' => $routeName,
            'url' => $request->fullUrl(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'response_status' => $responseStatus,
            'request_data' => self::sanitizeInput($request->except(self::$sensitiveKeys)),
            'source' => self::resolveSource($request),
        ], $extra));
    }

    public static function shouldSkip(Request $request): bool
    {
        if (! config('masterlog.enabled', true)) {
            return true;
        }

        $method = strtoupper($request->method());
        $logGet = (bool) config('masterlog.log_get', false);

        if ($method === 'GET' && ! $logGet) {
            return true;
        }

        if ($method === 'OPTIONS' || $method === 'HEAD') {
            return true;
        }

        $path = strtolower('/'.ltrim($request->path(), '/'));

        foreach ((array) config('masterlog.exclude_paths', []) as $excluded) {
            $excluded = strtolower(trim($excluded));
            if ($excluded !== '' && Str::startsWith($path, $excluded)) {
                return true;
            }
        }

        $routeName = optional($request->route())->getName();
        if ($routeName) {
            foreach ((array) config('masterlog.exclude_route_prefixes', []) as $prefix) {
                if ($prefix !== '' && Str::startsWith($routeName, $prefix)) {
                    return true;
                }
            }
        }

        return false;
    }

    protected static function resolveActor(?Request $request): array
    {
        if ($request && Auth::guard('admin')->check()) {
            $admin = Auth::guard('admin')->user();
            $role = null;
            try {
                $role = method_exists($admin, 'getRoleNames')
                    ? $admin->getRoleNames()->first()
                    : null;
            } catch (Throwable $e) {
                $role = null;
            }

            return [
                'type' => 'admin',
                'id' => $admin->id ?? null,
                'name' => $admin->name ?? $admin->email ?? 'Admin',
                'role' => $role ?: 'admin',
            ];
        }

        if ($request && Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();

            return [
                'type' => 'user',
                'id' => $user->id ?? null,
                'name' => $user->name ?? $user->email ?? $user->phone_number ?? 'User',
                'role' => 'customer',
            ];
        }

        if ($request && Auth::guard('sanctum')->check()) {
            $user = Auth::guard('sanctum')->user();

            return [
                'type' => 'user',
                'id' => $user->id ?? null,
                'name' => $user->name ?? $user->email ?? $user->phone_number ?? 'User',
                'role' => 'customer',
            ];
        }

        // Sanctum token user via $request->user()
        if ($request && $request->user()) {
            $user = $request->user();

            return [
                'type' => 'user',
                'id' => $user->id ?? null,
                'name' => $user->name ?? $user->email ?? $user->phone_number ?? 'User',
                'role' => 'customer',
            ];
        }

        return [
            'type' => 'guest',
            'id' => null,
            'name' => 'Guest',
            'role' => 'guest',
        ];
    }

    protected static function resolveSource(?Request $request): string
    {
        if (! $request) {
            return 'system';
        }

        $path = '/'.ltrim($request->path(), '/');

        if (Str::startsWith($path, 'manager') || Str::startsWith($path, 'admin')) {
            return 'admin_panel';
        }

        if ($request->is('api/*') || Str::startsWith($path, 'api/')) {
            $ua = strtolower((string) $request->userAgent());
            if (Str::contains($ua, ['okhttp', 'dalvik', 'android', 'iphone', 'ipad', 'cfnetwork', 'mobile app', 'timesmedico'])) {
                return 'mobile_app';
            }

            if ($request->headers->has('X-App-Client') || $request->headers->has('X-Mobile-App')) {
                return 'mobile_app';
            }

            return 'api';
        }

        return 'frontend';
    }

    protected static function guessAction(Request $request): string
    {
        $routeName = (string) optional($request->route())->getName();
        $lower = strtolower($routeName.' '.$request->path());

        if (Str::contains($lower, ['login', 'logout', 'register', 'otp', 'verify'])) {
            if (Str::contains($lower, 'logout')) {
                return 'logout';
            }
            if (Str::contains($lower, 'register')) {
                return 'register';
            }
            if (Str::contains($lower, ['otp', 'verify'])) {
                return 'verify';
            }

            return 'login';
        }

        return match (strtoupper($request->method())) {
            'POST' => Str::contains($lower, ['destroy', 'delete']) ? 'delete' : 'create',
            'PUT', 'PATCH' => 'update',
            'DELETE' => 'delete',
            'GET' => 'view',
            default => strtolower($request->method()),
        };
    }

    protected static function guessModule(?string $routeName, string $path): string
    {
        if ($routeName) {
            $parts = explode('.', $routeName);
            foreach (array_reverse($parts) as $part) {
                if (! in_array($part, ['index', 'show', 'create', 'store', 'edit', 'update', 'destroy', 'list', 'filter', 'post', 'get'], true)) {
                    return Str::headline(str_replace(['-', '_'], ' ', $part));
                }
            }
        }

        $segments = array_values(array_filter(explode('/', trim($path, '/'))));
        if (! empty($segments)) {
            $skip = ['manager', 'admin', 'dashboard', 'api', 'authentication'];
            foreach ($segments as $segment) {
                if (! in_array(strtolower($segment), $skip, true) && ! ctype_digit($segment)) {
                    return Str::headline(str_replace(['-', '_'], ' ', $segment));
                }
            }
        }

        return 'General';
    }

    protected static function buildRequestDescription(Request $request, ?string $routeName, string $path): string
    {
        $action = self::guessAction($request);
        $module = self::guessModule($routeName, $path);

        return sprintf(
            '%s %s via %s %s',
            Str::headline($action),
            $module,
            strtoupper($request->method()),
            $routeName ?: $path
        );
    }

    protected static function buildDescription(array $payload): string
    {
        $bits = array_filter([
            $payload['action'] ?? null,
            $payload['module'] ?? null,
            $payload['method'] ?? null,
        ]);

        return $bits ? implode(' · ', $bits) : 'Activity recorded';
    }

    protected static function sanitizeInput(array $input): array
    {
        $clean = [];

        foreach ($input as $key => $value) {
            $keyLower = strtolower((string) $key);

            foreach (self::$sensitiveKeys as $sensitive) {
                if (Str::contains($keyLower, $sensitive)) {
                    $clean[$key] = '[REDACTED]';

                    continue 2;
                }
            }

            if (is_array($value)) {
                $clean[$key] = self::sanitizeInput($value);
            } elseif (is_object($value)) {
                $clean[$key] = '[object]';
            } elseif (is_string($value) && strlen($value) > 2000) {
                $clean[$key] = Str::limit($value, 2000);
            } else {
                $clean[$key] = $value;
            }
        }

        // Keep payload reasonable
        $encoded = json_encode($clean);
        if ($encoded !== false && strlen($encoded) > 20000) {
            return ['_truncated' => true, 'keys' => array_keys($clean)];
        }

        return $clean;
    }
}
