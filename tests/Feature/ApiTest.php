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


class ApiTest extends TestCase
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

    public function test_Unauthenticated_User_Try_To_Get_Hops()
    {
        $this->expectException(UnauthorizedException::class);
        $response = $this->get('/api/hops');
    }


    public function test_Authenticated_User_Try_To_Get_Hops()
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

    public function test_Unauthenticated_User_Try_To_Get_Fermentables()
    {
        $this->expectException(UnauthorizedException::class);
        $response = $this->get('/api/fermentables');
    }


    public function test_Authenticated_User_Try_To_Get_Fermentables()
    {

        $user = $this->createUser('sydney99@example.org');

        $response = $this->get('api/fermentables', $this->headers($user));

        $response->assertStatus(200)
            ->assertJsonStructure([
                    'data',
                    'pagination'

                ]
            );
    }

    public function test_Unauthenticated_User_Try_To_Get_Extras()
    {
        $this->expectException(UnauthorizedException::class);
        $response = $this->get('/api/extras');
    }


    public function test_Authenticated_User_Try_To_Get_Extras()
    {

        $user = $this->createUser('sydney99@example.org');

        $response = $this->get('api/extras', $this->headers($user));

        $response->assertStatus(200)
            ->assertJsonStructure([
                    'data',
                    'pagination'

                ]
            );
    }

    public function test_Unauthenticated_User_Try_To_Get_Yeasts()
    {
        $this->expectException(UnauthorizedException::class);
        $response = $this->get('/api/yeasts');
    }


    public function test_Authenticated_User_Try_To_Get_Yeasts()
    {

        $user = $this->createUser('sydney99@example.org');

        $response = $this->get('api/yeasts', $this->headers($user));

        $response->assertStatus(200)
            ->assertJsonStructure([
                    'data',
                    'pagination'

                ]
            );
    }
}
