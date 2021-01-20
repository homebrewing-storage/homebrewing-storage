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
        $response = $this->get('/api/hops')
            ->assertStatus(401);

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
        $response = $this->get('/api/fermentables')
            ->assertStatus(401);
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
        $response = $this->get('/api/extras')
            ->assertStatus(401);
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
        $response = $this->get('/api/yeasts')
            ->assertStatus(401);

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

    public function test_Unauthenticated_User_Try_To_Get_Notifications()
    {
        $response = $this->get('/api/notifications')
            ->assertStatus(401);
    }


    public function test_Authenticated_User_Try_To_Get_Notifications()
    {
        $user = $this->createUser('sydney99@example.org');
        $response = $this->get('api/notifications', $this->headers($user));
        $response->assertStatus(200);
    }

    public function test_Unauthenticated_User_Try_To_Get_UnreadNotifications()
    {
        $response = $this->get('/api/unread-Notifications')
            ->assertStatus(401);
    }


    public function test_Authenticated_User_Try_To_Get_UnreadNotifications()
    {
        $user = $this->createUser('sydney99@example.org');
        $response = $this->get('api/unread-Notifications', $this->headers($user));
        $response->assertStatus(200);
    }

    public function test_Unauthenticated_User_Try_To_Get_NumberOfUnreadNotifications()
    {
        $response = $this->get('/api/number-Of-Unread-Notifications')
            ->assertStatus(401);
    }


    public function test_Authenticated_User_Try_To_Get_NumberOfUnreadNotifications()
    {
        $user = $this->createUser('sydney99@example.org');
        $response = $this->get('api/number-Of-Unread-Notifications', $this->headers($user));
        $response->assertStatus(200);
    }

    public function test_Unauthenticated_User_Try_To_Get_Settings()
    {
        $response = $this->get('/api/settings')
            ->assertStatus(401);
    }


    public function test_Authenticated_User_Try_To_Get_Settings()
    {
        $user = $this->createUser('sydney99@example.org');
        $response = $this->get('api/settings', $this->headers($user));
        $response->assertStatus(200);
    }
}
