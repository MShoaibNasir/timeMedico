<?php

namespace App\Services;

use App\Exceptions\ApiException;
use App\Exceptions\CustomException;
use App\Models\User;
use App\Repositories\UserAuthRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserAuthService
{
    protected UserAuthRepository $userRepo;

    public function __construct(UserAuthRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(array $data): User
    {
        if (isset($data['profile_image'])) {
            $file_name = FileService::upload($data['profile_image'], 'uploads/general/media/userProfile');
            $data['profile_image'] = $file_name;
        }
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepo->create($data);
        // event(new Registered($user));

        return $user;
    }

    public function login(array $credentials)
    {
        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw new ApiException('Invalid email or password.', 401);
        }
        // if($user->is_paid==0){
        //     throw new ApiException('Your Subscription is Not Active!', 401);
        // }
        if (! $user->hasVerifiedEmail()) {
            abort(401, 'Account Not Verified.');
        }
        $user->token = $user->createToken('PICG')->plainTextToken;

        return $user;
    }

    public function forgotPassword(string $email): void
    {
        $user = $this->userRepo->findByEmail($email);

        if (! $user) {
            throw new CustomException('User with this email not found.');
        }

        // Send reset password link
        Password::sendResetLink(['email' => $email]);
    }

    public function resetPassword(array $data): void
    {
        $status = Password::reset(
            $data,
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            throw new CustomException('Failed to reset password. Token may be invalid or expired.');
        }
    }

    public function verifyEmail(int $userId): void
    {
        $user = $this->userRepo->findById($userId);

        if (! $user) {
            throw new CustomException('User not found.');
        }

        if ($user->hasVerifiedEmail()) {
            throw new CustomException('Email already verified.');
        }

        $user->markEmailAsVerified();

        event(new Verified($user));
    }
}
