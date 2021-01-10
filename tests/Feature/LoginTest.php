<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Exceptions\Auth\UnauthorizedException;
use App\Models\User;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;


class LoginTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    protected function headers($user = null): array
    {
        $headers = ['Accept' => 'application/json'];

        if ($user) {
            $token = $user->createToken($user->email)->plainTextToken;
            $headers['Authorization'] = 'Bearer ' . $token;
        }

        return $headers;
    }

    protected function createUser(string $email)
    {
        $user = User::factory()->create([
            'email' => $email,
            'password' => Hash::make('password'),
        ]);

        return $user;
    }


    public function __toString()
    {
        return $this->toString();
    }


    public function test_User_Try_Login_With_Correct_Credentials()
    {
        $user = $this->createUser('sydney99@example.org');

        $loginData = ['email' => 'sydney99@example.org', 'password' => 'password'];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "token",
            ]);
    }


    public function test_User_Try_Login_With_Incorrect_Email()
    {
        $user = $this->createUser("dupa@dupa.pl");

        $loginData = ['email' => 'sydney99@example.org', 'password' => 'password'];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(422);

    }


    public function test_User_Try_Login_With_Incorrect_Password()
    {
        $this->expectException(UnauthorizedException::class);

        $user = User::factory()->create([
            'email' => 'sydney99@example.org',
            'password' => Hash::make('dupa'),
        ]);

        $loginData = ['email' => 'sydney99@example.org', 'password' => 'password'];

        $this->json('POST', 'api/login', $loginData, ['Accept' => 'application/json']);

    }

    public function test_Unauthenticated_Users_Try_To_Get_ApiHops()
    {
        $this->expectException(UnauthorizedException::class);
        $response = $this->get('/api/hops');
    }


    public function test_Authenticated_Users_Try_To_Get_ApiHops()
    {

        $user = $this->createUser('sydney99@example.org');

        $response = $this->get('api/hops', $this->headers($user));

        $response->assertStatus(200)
            ->assertJsonStructure([
                    'data',
                    'pagination'

                ]
            );
    }
}
