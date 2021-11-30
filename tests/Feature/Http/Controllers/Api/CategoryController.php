<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Model\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryController extends TestCase
{
    use DatabaseMigrations;

    public function testRouteNotFound()
    {
        $response = $this->json("GET", '/teste');

        $response->assertStatus(404);
    }

    public function testListCategory()
    {
        $category = factory(Category::class)->create();
        $response = $this->json("GET", '/api/categories');

        $response->assertStatus(200);
        $response->assertJson([$category->toArray()]);
    }

    public function testValidateCreate()
    {
        $response = $this->json("POST", '/api/categories', []);

        $response->assertStatus(422);
    }

    public function testCreate()
    {
        $response = $this->json("POST", '/api/categories', [
            "name" => "test"
        ]);

        $id = $response->json("id");
        $category = Category::find($id);

        $response->assertStatus(201);
        $response->assertJson($category);
    }

    public function testValidateUpdate()
    {
        $response = $this->json("PUT", '/api/categories', []);
        $response->assertStatus(422);
    }

    public function testUpdate() {
        $category = Category::create([
            "name" => "test"
        ]);

        $response = $this->json("PUT", '/api/categories/' . $category->id, [
            "name" => "test updated"
        ]);
        
        $name = $response->json("name");
        $response->assertStatus(204);
        $this->assertEquals("test updated", $name);
    }
}
