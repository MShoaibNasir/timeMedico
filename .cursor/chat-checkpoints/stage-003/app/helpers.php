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
     * Allow only same-app frontend URLs (never admin/auth endpoints).
     */
    function frontend_sanitize_return_url(?string $url): ?string
    {
        if (! $url) {
            return null;
        }

        $appUrl = rtrim((string) config('app.url'), '/');
        $parsed = parse_url($url);
        $appHost = parse_url($appUrl, PHP_URL_HOST);

        if (! empty($parsed['host']) && $parsed['host'] !== $appHost) {
            return null;
        }

        $path = $parsed['path'] ?? '/';
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

        return $appUrl . $path . $query;
    }
}

if (! function_exists('frontend_store_intended_url')) {
    /**
     * Remember where a frontend guest should return after login.
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

if (! function_exists('frontend_login_url')) {
    /**
     * Build the frontend login URL, optionally carrying a return page.
     */
    function frontend_login_url(?string $returnUrl = null): string
    {
        $returnUrl = frontend_sanitize_return_url($returnUrl ?: url()->current());

        return $returnUrl
            ? route('frontend.login', ['redirect' => $returnUrl])
            : route('frontend.login');
    }
}

if (! function_exists('frontend_redirect_to_login')) {
    /**
     * Store intended URL and send the guest to the frontend login page.
     */
    function frontend_redirect_to_login(?string $returnUrl = null): RedirectResponse
    {
        frontend_store_intended_url($returnUrl ?: url()->current());

        return redirect()->to(frontend_login_url($returnUrl ?: url()->current()));
    }
}

if (! function_exists('frontend_guest_login_response')) {
    /**
     * JSON (AJAX) or redirect response requiring frontend login.
     */
    function frontend_guest_login_response(?Request $request = null, ?string $returnUrl = null, string $message = 'Please log in to continue.'): JsonResponse|RedirectResponse
    {
        $request = $request ?: request();
        $returnUrl = frontend_sanitize_return_url($returnUrl ?: url()->previous()) ?: url()->current();
        frontend_store_intended_url($returnUrl);
        $loginUrl = frontend_login_url($returnUrl);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status' => false,
                'login_required' => true,
                'redirect' => $loginUrl,
                'message' => $message,
            ]);
        }

        return frontend_redirect_to_login($returnUrl);
    }
}