<?php

namespace App\Repositories;
use App\Models\User;
use App\Mail\SignupMail;
use Illuminate\Support\Facades\Mail;

class UserAuthRepository
{
    public function create(array $data): User
    {

        return User::create($data);
  
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function findById(int $id): ?User
    {
        return User::find($id);
    }
}
