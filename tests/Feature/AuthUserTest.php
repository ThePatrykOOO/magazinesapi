<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class AuthUserTest extends TestCase
{
    /**
     * @var User
     */
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::query()->first();
    }


    public function testShouldLoginUserWithoutData()
    {
        $response =  $this->actingAs($this->user, 'api')
            ->json('POST', '/api/authorize');
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function testShouldAuthUser()
    {
        $user = User::query()->first();
        $data = [
            'email' => $user->email,
            'password' => 'admin'
        ];

        $response =  $this->actingAs($this->user, 'api')
            ->json('POST', '/api/authorize', $data);
        $response->assertStatus(Response::HTTP_OK);

        $responseContent = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('access_token', $responseContent);
        $this->assertArrayHasKey('token_type', $responseContent);
    }
}
