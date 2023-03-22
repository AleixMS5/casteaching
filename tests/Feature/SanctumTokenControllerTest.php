<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
/**
 * @covers SanctumTokenController
 */
class SanctumTokenControllerTest extends TestCase
{
    use RefreshDatabase;



//device_name_is_required_for_issuing_tokens

    /**
    @test
     */
    public function email_is_valid_for_issuing_tokens()
    {
        $response = $this->postJson('/api/sanctum/token',[
            'email'=>'3433',
            'password' => '12323213',
            'device_name' =>"pepe"."'s device",
        ]);
        $response->assertStatus(422);
        $jsonResponse= json_decode($response->getContent());
        $this->assertEquals('The email must be a valid email address.', $jsonResponse->message);
        $this->assertEquals('The email must be a valid email address.', $jsonResponse->errors->email[0]);
    }
    /**
    @test
     */
    public function password_is_required_for_issuing_tokens()
    {
        $response = $this->postJson('/api/sanctum/token',[
            'email'=>'ams@gmail.com',
            'password' => '12323213',

        ]);
        $response->assertStatus(422);
        $jsonResponse= json_decode($response->getContent());
        $this->assertEquals('The device name field is required.', $jsonResponse->message);
        $this->assertEquals('The device name field is required.', $jsonResponse->errors->device_name[0]);
    }
    /**
    @test
     */
    public function device_name_is_required_for_issuing_tokens()
    {
        $response = $this->postJson('/api/sanctum/token',[
            'email'=>'ams@gmail.com',

            'device_name' =>"pepe"."'s device",
        ]);
        $response->assertStatus(422);
        $jsonResponse= json_decode($response->getContent());
        $this->assertEquals('The password field is required.', $jsonResponse->message);
        $this->assertEquals('The password field is required.', $jsonResponse->errors->password[0]);
    }


    /**
    @test
     */
    public function email_is_required_for_issuing_tokens()
    {
        $response = $this->postJson('/api/sanctum/token',[
            'password' => '12323213',
            'device_name' =>"pepe"."'s device",
        ]);
        $response->assertStatus(422);
        $jsonResponse= json_decode($response->getContent());
        $this->assertEquals('The email field is required.', $jsonResponse->message);
        $this->assertEquals('The email field is required.', $jsonResponse->errors->email[0]);
    }
    /**
    @test
     */
    public function invalid_email_gives_incorrect_credentials_error()
    {
        $user= User::create([
            'name'=>'pepe' ,
            'email'=>'pepe@gmail.com',
            'password'=>'12345678'
        ]);

        $response = $this->postJson('/api/sanctum/token',[
            'email' => 'another_email',
            'password' => $user->password,
            'device_name' => $user->name."'s device",
        ]);

        $response->assertStatus(422);

    }
    /**
     @test
     */
    public function user_with_valid_credentials_can_issue_a_token()
    {
//        $this->withoutExceptionHandling();
        $user= User::create([
           'name'=>'pepe' ,
            'email'=>'pepe@gmail.com',
            'password'=>Hash::make('12345678')
        ]);
        $this->assertCount(0,$user->tokens);

        $response = $this->postJson('/api/sanctum/token',[
            'email' => $user->email,
            'password' => '12345678',
            'device_name' => $user->name."'s device",
        ]);

        $response->assertStatus(200);
        $this->assertNotNull($response->getContent());
        $this->assertCount(1,$user->fresh()->tokens);
    }


}
