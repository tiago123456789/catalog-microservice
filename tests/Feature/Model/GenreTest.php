<?php

namespace Tests\Model\Feature;

use App\Model\Genre;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GenreTest extends TestCase
{

    use DatabaseMigrations;

    public function testCreate()
    {
        $genre = Genre::create([
            "name" => "teste"
        ]);

        $this->assertEquals("teste", $genre->name);
    }

    public function testUpdate()
    {
        $genre = Genre::create([
            "name" => "teste"
        ]);

        $genre->update([
            "name" => "teste updated",
            "is_active" => true
        ]);

        $this->assertEquals("teste updated", $genre->name);
        $this->assertTrue((bool) $genre->is_active);

    }

    public function testFindAll()
    {
        factory(Genre::class, 10)->create();
        $genres = Genre::all();
        $this->assertEquals(10, count($genres));
    }
}
