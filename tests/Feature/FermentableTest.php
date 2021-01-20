<?php

use App\Models\Fermentable;
use App\Models\FermentableType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class FermentableTest extends TestCase
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

    protected function createFermentableType()
    {
        $fermentableType = FermentableType::factory()->create([
            'name' => 'Sugar',
        ]);

        return $fermentableType;
    }



    protected function createFirstFermentable(User $user,FermentableType $fermentableType)
    {
        $fermentable = Fermentable::factory()->create([
            'user_id' => $user->id,
            'name' => 'name1',
            'type_id' => $fermentableType->id,
            'yield' =>'1',
            'ebc'=> '1',
            'amount' => '1',
            'expiration_date' => '2009-05-12T00:00:00.000000Z',

        ]);
        return $fermentable;
    }

    protected function createSecondFermentable(User $user, FermentableType $fermentableType)
    {
        $fermentable = Fermentable::factory()->create([
            'user_id' => $user->id,
            'name' => 'name2',
            'type_id' => $fermentableType->id,
            'yield' =>'2',
            'ebc'=> '2',
            'amount' => '2',
            'expiration_date' => '2008-05-12T00:00:00.000000Z',
        ]);
        return $fermentable;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function test_Can_Create_a_Fermentable()
    {
        $user =$this->createUser('sydney99@example.org');
        $fermentableType = $this->createFermentableType();
        $fermentable = $this->createFirstFermentable($user,$fermentableType);

        $this->assertInstanceOf(Fermentable::class, $fermentable);
        $this->assertEquals('14', $fermentable->user_id);
        $this->assertEquals('name1', $fermentable->name);
        $this->assertEquals('1', $fermentable->type_id);
        $this->assertEquals('1', $fermentable->yield);
        $this->assertEquals('1', $fermentable->ebc);
        $this->assertEquals('1', $fermentable->amount);
    }

    public function test_Authenticated_User_Try_To_See_His_Fermentables_And_Return_Json_Should_Be_Ok()
    {
        $user =$this->createUser('sydney99@example.org');
        $fermentableType = $this->createFermentableType();
        $fermentable = $this->createFirstFermentable($user,$fermentableType);
        $fermentable = $this->createSecondFermentable($user,$fermentableType);


        $response = $this->get('api/fermentables', $this->headers($user));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'name1',
                'type' => 'Sugar',
                'yield' =>'1',
                'ebc'=> '1',
                'amount' => '1',
                'expiration_date' => '2009-05-12',


            ])
            ->assertJsonFragment([
                'name' => 'name2',
                'type' => 'Sugar',
                'yield' =>'2',
                'ebc'=> '2',
                'amount' => '2',
                'expiration_date' => '2008-05-12',
            ]);

    }

    public function test_Authenticated_User_Try_To_See_His_Fermentables_And_Return_Json_Should_Be_Wrong()
    {
        $user =$this->createUser('sydney99@example.org');
        $fermentableType = $this->createFermentableType();
        $fermentable = $this->createFirstFermentable($user,$fermentableType);
        $fermentable = $this->createSecondFermentable($user,$fermentableType);


        $response = $this->get('api/fermentables', $this->headers($user));

        $response->assertStatus(200)
            ->assertJsonFragment([
                'name' => 'name1',
                'type' => 'dupa',
                'yield' =>'1',
                'ebc'=> '1',
                'amount' => '1',
                'expiration_date' => '2009-05-12',


            ])
            ->assertJsonFragment([
                'name' => 'name2',
                'type' => 'Sugar',
                'yield' =>'2',
                'ebc'=> '2',
                'amount' => '2',
                'expiration_date' => '2008-05-12',
            ]);

    }

    public function test_Authenticated_User_Try_To_Add_Fermentable_And_Return_Json_Should_Be_Ok()
    {

        $user = $this->createUser('sydney99@example.org');
        $fermentableType= $this->createFermentableType();


        $Data = ['type_id' =>$fermentableType->id, 'name'=>'name3', 'yield' =>'3','ebc' =>'3',  'amount'=>'3', 'expiration_date'=> '2009-05-12'];

        $this->json('POST', 'api/fermentables', $Data,$this->headers($user))
            ->assertStatus(201)
            ->assertJsonFragment([
                'name' => 'name3',
                'yield' =>'3',
                'ebc' =>'3',
                'amount' => '3',
                'expiration_date' => '2009-05-12',
            ]);
    }


    public function test_Authenticated_User_Try_To_Add_Fermentable_And_Return_Json_Should_Be_Wrong()
    {

        $user = $this->createUser('sydney99@example.org');
        $fermentableType= $this->createFermentableType();


        $Data = ['type_id' =>$fermentableType->id, 'name'=>'name3', 'yield' =>'3','ebc' =>'3',  'amount'=>'3', 'expiration_date'=> '2009-05-12'];

        $this->json('POST', 'api/fermentables', $Data,$this->headers($user))
            ->assertStatus(201)
            ->assertJsonFragment([
                'name' => 'name3',
                'yield' =>'3',
                'ebc' =>'3',
                'amount' => 'dupa',
                'expiration_date' => '2009-05-12',
            ]);
    }

}
