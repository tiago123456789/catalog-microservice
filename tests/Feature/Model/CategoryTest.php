<?php

namespace Tests\Feature\Model;

use App\Model\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{

    use DatabaseMigrations;

    public function testFindAll()
    {
        factory(Category::class, 2)->create();
        $categories = Category::all();

        $this->assertEquals(2, count($categories));
    }

    public function testCreate()
    {
        $category = Category::create([
            "name" => "test creation"
        ]);
        $category->refresh();
        $this->assertEquals("test creation", $category->name);
        $this->assertNull($category->description);
        $this->assertTrue((bool)$category->is_active);
    }

    public function testUpdate()
    {
        $category = Category::create([
            "name" => "test creation"
        ]);
        $category->refresh();
        $category->update([
            "name" => "teste created updated",
            "is_active" => false
        ]);
        $this->assertEquals("teste created updated", $category->name);
        $this->assertNull($category->description);
        $this->assertFalse((bool)$category->is_active);
    }
}
