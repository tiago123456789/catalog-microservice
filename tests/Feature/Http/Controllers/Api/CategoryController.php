<?php

namespace Tests\Feature\Http\Controllers\Api;

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

    public function testValidateUpdate()
    {
        $response = $this->json("PUT", '/api/categories', []);

        $response->assertStatus(422);
    }
}
