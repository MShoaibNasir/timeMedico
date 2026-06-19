<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordUserAuthRequest;
use App\Http\Requests\LoginUserAuthRequest;
use App\Http\Requests\RegisterUserAuthRequest;
use App\Http\Requests\ResetPasswordUserAuthRequest;
use App\Services\UserAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function __construct(
        protected UserAuthService $authService
    ) {}

    public function showRegisterForm()
    {
        return view('backend.User.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function showResetPasswordForm(Request $request)
    {
        return view('auth.reset-password')->with([
            'token' => $request->token,
            'email' => $request->email,
        ]);
    }

    public function showEmailVerifiedSuccess()
    {
        return view('auth.verified');
    }

    public function register(RegisterUserAuthRequest $request): JsonResponse
    {

        $user = $this->authService->register($request->validated());

        return response()->json([
            'message' => 'Registration successful. Please verify your email.',
            'user' => $user,
        ], 201);
    }

    public function login(LoginUserAuthRequest $request): JsonResponse
    {
        try {
            $token = $this->authService->login($request->validated());

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function forgotPassword(ForgotPasswordUserAuthRequest $request): JsonResponse
    {
        try {
            $this->authService->forgotPassword($request->email);

            return response()->json(['message' => 'Password reset link sent to your email']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function resetPassword(ResetPasswordUserAuthRequest $request): JsonResponse
    {
        try {
            $this->authService->resetPassword($request->validated());

            return response()->json(['message' => 'Password reset successful']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function verifyEmail(int $userId): JsonResponse
    {
        try {
            $this->authService->verifyEmail($userId);

            return response()->json(['message' => 'Email verified successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
}
