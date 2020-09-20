<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class PublisherControllerTest extends TestCase
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

    public function testShouldGetAllMagazines()
    {
        $response = $this->actingAs($this->user, 'api')
            ->json('GET', '/api/publishers/list');
        $response->assertStatus(Response::HTTP_OK);

        $publishers = json_decode($response->getContent(), true);

        foreach ($publishers as $publisher) {
            $this->assertArrayHasKey('id', $publisher);
            $this->assertArrayHasKey('name', $publisher);
        }
    }
}
