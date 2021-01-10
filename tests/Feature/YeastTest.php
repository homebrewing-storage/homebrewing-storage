<?php

use App\Models\Hop;
use App\Models\User;
use App\Models\Yeast;
use App\Models\YeastType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class YeastTest extends TestCase
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

    protected function createYeastType()
    {
        $yeastType = YeastType::factory()->create([
            'name' => 'Liquid',
        ]);

        return $yeastType;
    }

    protected function createFirstYeast(User $user, YeastType $yeastType)
    {
        $yeast = Yeast::factory()->create([
            'user_id' => $user->id,
            'type_id' => $yeastType->id,
            'name' => 'name1',
            'amount' => '1',
            'expiration_date' => '2009-05-12T00:00:00.000000Z',
        ]);
        return $yeast;
    }

    protected function createSecondYeast(User $user, YeastType $yeastType)
    {
        $yeast = Yeast::factory()->create([
            'user_id' => $user->id,
            'type_id' => $yeastType->id,
            'name' => 'name2',
            'amount' => '2',
            'expiration_date' => '2008-05-12T00:00:00.000000Z',
        ]);
        return $yeast;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function test_Can_Create_a_Yeast()
    {
        $user = $this->createUser('sydney99@example.org');
        $yeastType = $this->createYeastType();
        $yeast = $this->createFirstYeast($user, $yeastType);

        $this->assertInstanceOf(Yeast::class, $yeast);
        $this->assertEquals('14', $yeast->user_id);
        $this->assertEquals('1', $yeast->type_id);
        $this->assertEquals('name1', $yeast->name);
        $this->assertEquals('1', $yeast->amount);
    }

    public function test_Authenticated_User_Try_To_See_His_Yeasts_And_Return_Json_Should_Be_Ok()
    {

        $user = $this->createUser('sydney99@example.org');
        $yeastType = $this->createYeastType();
        $yeast1 = $this->createFirstYeast($user, $yeastType);
        $yeast2 = $this->createSecondYeast($user, $yeastType);

        $response = $this->get('api/yeasts', $this->headers($user));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'name1',
                'type' => 'Liquid',
                'amount' => '1',
                'expiration_date' => '2009-05-12T00:00:00.000000Z',


            ])
            ->assertJsonFragment([
                'name' => 'name2',
                'type' => 'Liquid',
                'amount' => '2',
                'expiration_date' => '2008-05-12T00:00:00.000000Z',
            ]);

    }

    public function test_Authenticated_User_Try_To_See_His_Yeasts_And_Return_Json_Should_Be_Wrong()
    {

        $user = $this->createUser('sydney99@example.org');
        $yeastType = $this->createYeastType();
        $yeast1 = $this->createFirstYeast($user, $yeastType);
        $yeast2 = $this->createSecondYeast($user, $yeastType);

        $response = $this->get('api/yeasts', $this->headers($user));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'name1',
                'type' => 'Liquid',
                'amount' => '1',
                'expiration_date' => '2009-05-12T00:00:00.000000Z',


            ])
            ->assertJsonFragment([
                'name' => 'dupa',
                'type' => 'Liquid',
                'amount' => '2',
                'expiration_date' => '2008-05-12T00:00:00.000000Z',
            ]);

    }

    public function test_Authenticated_User_Try_To_Add_Yeast_And_Return_Json_Should_Be_Ok()
    {

        $user = $this->createUser('sydney99@example.org');
        $yeastType = $this->createYeastType();


        $Data = ['type_id' =>$yeastType->id, 'name'=>'name3', 'type'=>'Liquid',  'amount'=>'3', 'expiration_date'=> '2009-05-12T00:00:00.000000Z'];

        $this->json('POST', 'api/yeasts', $Data,$this->headers($user))
            ->assertStatus(201)
            ->assertJsonFragment([
                'name' => 'name3',
                'type'=>'Liquid',
                'amount' => '3',
                'expiration_date' => '2009-05-12T00:00:00.000000Z',
            ]);
    }

    public function test_Authenticated_User_Try_To_Add_Yeast_And_Return_Json_Should_Be_Wrong()
    {

        $user = $this->createUser('sydney99@example.org');
        $yeastType = $this->createYeastType();


        $Data = ['type_id' =>$yeastType->id, 'name'=>'name3', 'type'=>'Liquid',  'amount'=>'3', 'expiration_date'=> '2009-05-12T00:00:00.000000Z'];

        $this->json('POST', 'api/yeasts', $Data,$this->headers($user))
            ->assertStatus(201)
            ->assertJsonFragment([
                'name' => 'name3',
                'type'=>'dupa',
                'amount' => '3',
                'expiration_date' => '2009-05-12T00:00:00.000000Z',
            ]);
    }

}
