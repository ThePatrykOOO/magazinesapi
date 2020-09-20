<?php

namespace Tests\Feature;

use App\Magazine;
use App\Publisher;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Tests\TestCase;

class MagazineControllerTest extends TestCase
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

    public function testShouldGetMagazines()
    {
        $response = $this->actingAs($this->user, 'api')
            ->json('GET', '/api/magazines/search');
        $response->assertStatus(Response::HTTP_OK);

        $responseData = json_decode($response->getContent(), true)['data'];

        foreach ($responseData as $magazine) {
            $this->assertArrayHasKey('id', $magazine);
            $this->assertArrayHasKey('name', $magazine);
            $this->assertArrayHasKey('publisher_name', $magazine);
        }
    }

    public function testShouldFilterMagazinesByPublisher()
    {
        $publisher = Publisher::query()->first();
        $response = $this->actingAs($this->user, 'api')
            ->json('GET', '/api/magazines/search?publisher_id=' . $publisher->id);
        $response->assertStatus(Response::HTTP_OK);

        $responseData = json_decode($response->getContent(), true)['data'];

        foreach ($responseData as $magazine) {
            $this->assertArrayHasKey('id', $magazine);
            $this->assertArrayHasKey('name', $magazine);
            $this->assertArrayHasKey('publisher_name', $magazine);
            $this->assertSame(Arr::get($magazine,'publisher_name'), $publisher->name);
        }
    }

    public function testShouldFilterMagazinesByName()
    {
        $magazineItem = Magazine::query()->first();
        $response = $this->actingAs($this->user, 'api')
            ->json('GET', '/api/magazines/search?magazine_name=' . $magazineItem->name);
        $response->assertStatus(Response::HTTP_OK);

        $responseData = json_decode($response->getContent(), true)['data'];

        foreach ($responseData as $magazine) {
            $this->assertArrayHasKey('id', $magazine);
            $this->assertArrayHasKey('name', $magazine);
            $this->assertSame(Arr::get($magazine,'name'), $magazineItem->name);
            $this->assertArrayHasKey('publisher_name', $magazine);
        }
    }

    public function testShouldGetSingleMagazine()
    {
        $magazineItem = Magazine::query()->first();
        $response = $this->actingAs($this->user, 'api')
            ->json('GET', '/api/magazines/' . $magazineItem->id);
        $response->assertStatus(Response::HTTP_OK);

        $responseData = json_decode($response->getContent(), true)['data'];

        $this->assertSame(Arr::get($responseData,'id'), $magazineItem->id);
        $this->assertSame(Arr::get($responseData,'name'), $magazineItem->name);
        $this->assertSame(Arr::get($responseData,'publisher'), $magazineItem->publisher->name);
    }


}
