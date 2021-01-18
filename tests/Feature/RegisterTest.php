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


class RegisterTest extends TestCase
{

    use RefreshDatabase, WithFaker;


    public function test_User_Make_Account()
    {

        $loginData = ['name' => 'Jan','surname' =>'Kowalski','email' => 'test@mail.pl','password' => 'password','password_confirmation'=>'password'];

        $this->json('POST', 'api/register', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(201);

    }

    public function test_User_Make_Account_Without_Surname()
    {

        $loginData = ['name' => 'Jan','email' => 'test@mail.pl','password' => 'password','password_confirmation'=>'password'];

        $this->json('POST', 'api/register', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJsonFragment([
                "The surname field is required.",
            ]);

    }

    public function test_User_Make_Account_Without_Name()
    {

        $loginData = ['surname' =>'Kowalski','email' => 'test@mail.pl','password' => 'password','password_confirmation'=>'password'];

        $this->json('POST', 'api/register', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJsonFragment([
                "The name field is required."
            ]);

    }

    public function test_User_Make_Account_Without_Email()
    {

        $loginData = ['name' => 'Jan','surname' =>'Kowalski','password' => 'password','password_confirmation'=>'password'];

        $this->json('POST', 'api/register', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJsonFragment([
                "The email field is required."
            ]);

    }

    public function test_User_Make_Account_With_Uncorrect_Password()
    {

        $loginData = ['name' => 'Jan','surname' =>'Kowalski','email' => 'test@mail.pl','password' => 'password','password_confirmation'=>'password12'];

        $this->json('POST', 'api/register', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJsonFragment([
                "The password and password confirmation must match."
            ]);

    }


}
