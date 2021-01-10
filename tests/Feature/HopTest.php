<?php

use App\Models\Hop;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;


class HopTest extends TestCase
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
            'id' => ($id = '14'),
            'email' => $email,
            'password' => Hash::make('password'),
        ]);

        return $user;
    }

    protected function createFirstHop(User $user)
    {
        $hop = Hop::factory()->create([
            'user_id' => $user->id,
            'name' => 'name1',
            'amount' => '1',
            'alpha_acid' => '1',
            'expiration_date' => '2009-05-12T00:00:00.000000Z',
        ]);
        return $hop;
    }

    protected function createSecondHop(User $user)
    {
        $hop = Hop::factory()->create([
            'user_id' => $user->id,
            'name' => 'name2',
            'amount' => '2',
            'alpha_acid' => '2',
            'expiration_date' => '2008-05-12T00:00:00.000000Z',
        ]);
        return $hop;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function test_Can_Create_a_Hop()
    {
        $user = $this->createUser('sydney99@example.org');
        $hop = $this->createFirstHop($user);

        $this->assertInstanceOf(Hop::class, $hop);
        $this->assertEquals('14', $hop->user_id);
        $this->assertEquals('name1', $hop->name);
        $this->assertEquals('1', $hop->amount);
        $this->assertEquals('1', $hop->alpha_acid);
    }

    public function test_Authenticated_User_Try_To_See_His_Hops_And_Return_Json_Should_Be_Ok()
    {

        $user = $this->createUser('sydney99@example.org');
        $hop1 = $this->createFirstHop($user);
        $hop2 = $this->createSecondHop($user);

        $response = $this->get('api/hops', $this->headers($user));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'name1',
                'amount' => '1',
                'alpha_acid' => '1',
                'expiration_date' => '2009-05-12T00:00:00.000000Z',
            ])
            ->assertJsonFragment([
                'name' => 'name2',
                'amount' => '2',
                'alpha_acid' => '2',
                'expiration_date' => '2008-05-12T00:00:00.000000Z',
            ]);

    }

    public function test_Authenticated_User_Try_To_See_His_Hops_And_Return_Json_Should_Be_Wrong()
    {

        $user = $this->createUser('sydney99@example.org');
        $hop1 = $this->createFirstHop($user);
        $hop2 = $this->createSecondHop($user);

        $response = $this->get('api/hops', $this->headers($user));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'dupa',
                'amount' => '2',
                'alpha_acid' => '2',
                'expiration_date' => '2009-05-12T00:00:00.000000Z',
            ])
            ->assertJsonFragment([
                'name' => 'name2',
                'amount' => '3',
                'alpha_acid' => '3',
                'expiration_date' => '2008-05-12T00:00:00.000000Z',
            ]);

    }

    public function test_Authenticated_User_Try_To_Add_Hop_And_Return_Json_Should_Be_Ok()
    {

        $user = $this->createUser('sydney99@example.org');

        $Data = ['name' => 'name3', 'amount' => '3', 'alpha_acid' => '3', 'expiration_date' => '2009-05-12T00:00:00.000000Z'];

        $this->json('POST', 'api/hops', $Data, $this->headers($user))
            ->assertStatus(201)
            ->assertJsonFragment([
                'name' => 'name3',
                'amount' => '3',
                'alpha_acid' => '3',
                'expiration_date' => '2009-05-12T00:00:00.000000Z',
            ]);


    }

    public function test_Authenticated_User_Try_To_Add_Hop_And_Return_Json_Should_Be_Wrong()
    {

        $user = $this->createUser('sydney99@example.org');

        $Data = ['name' => 'name3', 'amount' => '3', 'alpha_acid' => '3', 'expiration_date' => '2009-05-12T00:00:00.000000Z'];

        $this->json('POST', 'api/hops', $Data, $this->headers($user))
            ->assertJsonFragment([
                'name' => 'name3',
                'amount' => '3',
                'alpha_acid' => '43',
                'expiration_date' => '2009-05-12T00:00:00.000000Z',
            ]);


    }
}

