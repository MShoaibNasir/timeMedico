<?php

use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

if (! function_exists('money')) {
    /**
     * Short helper for currency formatting - "Rs. 345.00"
     * Usage: money(345) instead of \App\Services\CartService::format(345)
     */
    function money(float $amount): string
    {
        return CartService::format($amount);
    }
}

if (! function_exists('frontend_sanitize_return_url')) {
    /**
     * Allow only same-app frontend paths (never admin/auth endpoints).
     * Returns a relative path so redirects work regardless of APP_URL host.
     */
    function frontend_sanitize_return_url(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        $url = trim($url);
        $parsed = parse_url($url);

        if ($parsed === false) {
            return null;
        }

        $host = $parsed['host'] ?? null;
        if ($host) {
            $allowedHosts = array_values(array_filter([
                parse_url((string) config('app.url'), PHP_URL_HOST),
                request()->getHost(),
            ]));

            if (! in_array($host, $allowedHosts, true)) {
                return null;
            }
        }

        $path = $parsed['path'] ?? '/';
        if ($path === '' || $path[0] !== '/') {
            $path = '/' . ltrim($path, '/');
        }

        $blockedPrefixes = [
            '/admin',
            '/manager',
            '/website/logout',
            '/login',
            '/register',
        ];

        foreach ($blockedPrefixes as $prefix) {
            if (str_starts_with($path, $prefix)) {
                return null;
            }
        }

        $query = isset($parsed['query']) ? '?' . $parsed['query'] : '';

        return $path . $query;
    }
}

if (! function_exists('frontend_store_intended_url')) {
    /**
     * Remember where a frontend guest should return after auth.
     */
    function frontend_store_intended_url(?string $url = null): void
    {
        $url = frontend_sanitize_return_url($url ?: url()->previous());

        if ($url) {
            session(['frontend.url.intended' => $url]);
        }
    }
}

if (! function_exists('frontend_pull_intended_url')) {
    /**
     * Consume the stored frontend return URL (falls back to home).
     */
    function frontend_pull_intended_url(): string
    {
        $url = frontend_sanitize_return_url(session()->pull('frontend.url.intended'));

        return $url ?: route('frontend.home.page');
    }
}

if (! function_exists('frontend_auth_url')) {
    /**
     * Frontend auth entry is /register (name, email, phone + OTP).
     */
    function frontend_auth_url(?string $returnUrl = null): string
    {
        $returnUrl = frontend_sanitize_return_url($returnUrl ?: url()->current());

        return $returnUrl
            ? route('frontend.register', ['redirect' => $returnUrl])
            : route('frontend.register');
    }
}

if (! function_exists('frontend_login_url')) {
    /**
     * @deprecated Use frontend_auth_url(); kept for existing call sites.
     */
    function frontend_login_url(?string $returnUrl = null): string
    {
        return frontend_auth_url($returnUrl);
    }
}

if (! function_exists('frontend_redirect_to_login')) {
    /**
     * Store intended URL and send the guest to the frontend register/auth page.
     */
    function frontend_redirect_to_login(?string $returnUrl = null): RedirectResponse
    {
        $returnUrl = $returnUrl ?: url()->current();
        frontend_store_intended_url($returnUrl);

        return redirect()->to(frontend_auth_url($returnUrl));
    }
}

if (! function_exists('frontend_guest_login_response')) {
    /**
     * JSON (AJAX) or redirect response requiring frontend auth via /register.
     */
    function frontend_guest_login_response(?Request $request = null, ?string $returnUrl = null, string $message = 'Please log in to continue.'): JsonResponse|RedirectResponse
    {
        $request = $request ?: request();
        $returnUrl = frontend_sanitize_return_url($returnUrl ?: url()->previous()) ?: url()->current();
        frontend_store_intended_url($returnUrl);
        $authUrl = frontend_auth_url($returnUrl);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status' => false,
                'login_required' => true,
                'redirect' => $authUrl,
                'message' => $message,
            ]);
        }

        return frontend_redirect_to_login($returnUrl);
    }
}

if (! function_exists('master_log')) {
    /**
     * Write an entry to the master_logs table.
     * Usage: master_log(['action' => 'create', 'module' => 'Order', 'description' => 'Placed order']);
     */
    function master_log(array $attributes = []): ?\App\Models\MasterLog
    {
        return \App\Services\MasterLogger::log($attributes);
    }
}
