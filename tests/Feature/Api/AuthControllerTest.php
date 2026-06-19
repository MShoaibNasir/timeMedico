<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_successfully()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson('/api/authentication/register', $userData);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'id',
                'name',
                'email',
                'token',
            ],
            'message',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }

    //     public function test_user_can_login_successfully()
    // {
    //     // Step 1: Register the user using actual API (ensures password is hashed as expected)
    //     $userData = [
    //         'name' => 'Login User',
    //         'email' => 'login@example.com',
    //         'password' => 'password',
    //         'password_confirmation' => 'password',
    //     ];

    //     $this->postJson('/api/authentication/register', $userData);

    //     // Step 2: Now login using the same credentials
    //     $loginData = [
    //         'email' => 'login@example.com',
    //         'password' => 'password',
    //     ];

    //     $response = $this->postJson('/api/authentication/login', $loginData);

    //     $response->assertStatus(200); // <- This will now pass
    //     $response->assertJsonStructure([
    //         'success',
    //         'data' => [
    //             'id',
    //             'name',
    //             'email',
    //             'token',
    //         ],
    //         'message',
    //     ]);
    // }

}
