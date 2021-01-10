<?php

use App\Models\Extra;
use App\Models\ExtraType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ExtraTest extends TestCase
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

    protected function createExtraType()
    {
        $extraType = ExtraType::factory()->create([
            'name' => 'type_4',
        ]);

        return $extraType ;
    }



    protected function createFirstExtra(User $user,ExtraType $extraType)
    {
        $extra = Extra::factory()->create([
            'user_id' => $user->id,
            'type_id' => $extraType->id,
            'name' => 'name1',
            'amount' => '1',
            'expiration_date' => '2009-05-12T00:00:00.000000Z',

        ]);
        return $extra;
    }

    protected function createSecondExtra(User $user,ExtraType $extraType)
    {
        $extra = Extra::factory()->create([
            'user_id' => $user->id,
            'type_id' => $extraType->id,
            'name' => 'name2',
            'amount' => '2',
            'expiration_date' => '2008-05-12T00:00:00.000000Z',

        ]);
        return $extra;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function test_Can_Create_a_Extra()
    {
        $user =$this->createUser('sydney99@example.org');
        $extraType = $this->createExtraType();
        $extra = $this->createFirstExtra($user,$extraType);

        $this->assertInstanceOf(Extra::class, $extra);
        $this->assertEquals('14', $extra->user_id);
        $this->assertEquals('1', $extra->type_id);
        $this->assertEquals('name1', $extra->name);
        $this->assertEquals('1', $extra->amount);
    }

    public function test_Authenticated_User_Try_To_See_His_Extras_And_Return_Json_Should_Be_Ok()
    {
        $user =$this->createUser('sydney99@example.org');
        $extraType = $this->createExtraType();
        $extra = $this->createFirstExtra($user,$extraType);
        $extra = $this->createSecondExtra($user,$extraType);

        $response = $this->get('api/extras', $this->headers($user));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'name1',
                'amount' => '1',
                'expiration_date' => '2009-05-12T00:00:00.000000Z',
            ])
            ->assertJsonFragment([
                'name' => 'name2',
                'amount' => '2',
                'expiration_date' => '2008-05-12T00:00:00.000000Z',
            ]);

    }

    public function test_Authenticated_User_Try_To_See_His_Extras_And_Return_Json_Should_Be_Wrong()
    {
        $user =$this->createUser('sydney99@example.org');
        $extraType = $this->createExtraType();
        $extra = $this->createFirstExtra($user,$extraType);
        $extra = $this->createSecondExtra($user,$extraType);

        $response = $this->get('api/extras', $this->headers($user));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'name1',
                'amount' => '1',
                'expiration_date' => '2009-05-12T00:00:00.000000Z',
            ])
            ->assertJsonFragment([
                'name' => 'name2',
                'amount' => 'dupa22',
                'expiration_date' => '2008-05-12T00:00:00.000000Z',
            ]);

    }

    public function test_Authenticated_User_Try_To_Add_Extra_And_Return_Json_Should_Be_Ok()
    {

        $user = $this->createUser('sydney99@example.org');
        $extraType = $this->createExtraType();


        $Data = ['type_id' =>$extraType->id, 'name'=>'name3', 'amount'=>'3', 'expiration_date'=> '2009-05-12T00:00:00.000000Z'];

        $this->json('POST', 'api/extras', $Data,$this->headers($user))
            ->assertStatus(201)
            ->assertJsonFragment([
                'name' => 'name3',
                'amount' => '3',
                'expiration_date' => '2009-05-12T00:00:00.000000Z',
            ]);
    }

    public function test_Authenticated_User_Try_To_Add_Extra_And_Return_Json_Should_Be_Wrong()
    {

        $user = $this->createUser('sydney99@example.org');
        $extraType = $this->createExtraType();


        $Data = ['type_id' =>$extraType->id, 'name'=>'name3', 'amount'=>'3', 'expiration_date'=> '2009-05-12T00:00:00.000000Z'];

        $this->json('POST', 'api/extras', $Data,$this->headers($user))
            ->assertStatus(201)
            ->assertJsonFragment([
                'name' => 'name3',
                'amount' => 'dupa',
                'expiration_date' => '2009-05-12T00:00:00.000000Z',
            ]);
    }
}
