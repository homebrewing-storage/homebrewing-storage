<?php
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_Can_Create_a_User()
    {
        $user = User::factory()->make([
            'id' => ($id = '14'),
            'name' => ($name = 'lukasz'),
            'surname' => ($surname = 'dupa'),
            'email' => ($email = 'dupa12@wp.pl'),
            'password' =>($password = 'dupa12'),


        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('14', $user->id);
        $this->assertEquals('lukasz', $user->name);
        $this->assertEquals('dupa', $user->surname);
        $this->assertEquals('dupa12@wp.pl', $user->email);
        $this->assertEquals('dupa12', $user->password);
    }
}
