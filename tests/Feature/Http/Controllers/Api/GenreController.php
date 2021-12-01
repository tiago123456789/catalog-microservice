<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Model\Genre;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenreController extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFindAll()
    {
        factory(Genre::class, 2)->create();
        $response = $this->json("GET", "/api/genres");

        $response->assertStatus(200);
        $this->assertEquals(2, count($response->json()));
    }

    public function testFindByIdReturnStatus404()
    {
        $response = $this->json("GET", "/api/genres/10000");

        $response->assertStatus(404);
    }

    public function testFindByIdReturnStatus200()
    {
        $genre = Genre::create([
            "name" => "test"
        ]);
        $response = $this->json("GET", "/api/genres/" . $genre->id);

        $response->assertStatus(200);
    }

    public function testDestroyReturnStatus404()
    {
        $response = $this->json("DELETE", "/api/genres/10000");

        $response->assertStatus(404);
    }

    public function testDestroyReturnStatus200()
    {
        $genre = Genre::create([
            "name" => "test"
        ]);
        $response = $this->json("GET", "/api/genres/" . $genre->id);

        $response->assertStatus(200);
    }

    public function testCreateDataInvalid() {
        $response = $this->json("POST", "/api/genres", []);
        $response->assertStatus(422);
    }

    public function testCreate() {
        $response = $this->json("POST", "/api/genres", [
            "name" => "test created success"
        ]);

        $name = $response->json("name");
        $response->assertStatus(201);
        $this->assertEquals("test created success", $name);
    }

    public function testUpdateRegisterNotFound()
    {
        $response = $this->json("PUT", "/api/genres/10000");

        $response->assertStatus(404);
    }

    public function testUpdateButInvalidDataSended()
    {
        $genre = Genre::create([
            "name" => "test"
        ]);
        $response = $this->json("PUT", "/api/genres/" . $genre->id, []);

        $response->assertStatus(422);
    }

    public function testUpdate()
    {
        $genre = Genre::create([
            "name" => "test"
        ]);
        $response = $this->json("PUT", "/api/genres/" . $genre->id, [
            "name" => "test updated"
        ]);

        $name = $response->json("name");
        $response->assertStatus(204);
        $this->assertEquals("test updated", $name);
    }
}
