<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Model\Category;
use App\Model\Genre;
use App\Model\Video;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VideoController extends TestCase
{
    use DatabaseMigrations;

    public function testFindAllSuccess()
    {
        $response = $this->json("GET", "/api/videos");
        $response->assertStatus(200);
    }

    public function testFindByIdNotFoundRegister()
    {
        $response = $this->json("GET", "/api/videos/1");
        $response->assertStatus(404);
    }

    public function testFindByIdSuccess()
    {
        Video::create([
            "title" => "The ranch 2",
            "description" => "The ranch is one serie",
            "year_launched" => 2018,
            "opened" => false,
            "rating" => "16",
            "duration" => 50
        ]);

        $video = Video::first();
        $response = $this->json("GET", "/api/videos/" . $video->id);
        $title = $response->json("title");
        $description = $response->json("description");
        $response->assertStatus(200);
        $this->assertEquals($video->title, $title);
        $this->assertEquals($video->description, $description);
    }

    public function testDestroyNotFoundRegister()
    {
        $response = $this->json("GET", "/api/videos/1");
        $response->assertStatus(404);
    }

    public function testDestroySuccess()
    {
        Video::create([
            "title" => "The ranch 2",
            "description" => "The ranch is one serie",
            "year_launched" => 2018,
            "opened" => false,
            "rating" => "16",
            "duration" => 50
        ]);

        $video = Video::first();
        $response = $this->json("DELETE", "/api/videos/" . $video->id);
        $response->assertStatus(204);
    }

    public function testCreateFailInvalidData()
    {
        $response = $this->json("POST", "/api/videos", []);
        $response->assertStatus(422);
    }

    public function testCreateSuccess()
    {
        $category = factory(Category::class, 1)->create();
        $genre = factory(Genre::class, 1)->create();
        $response = $this->json("POST", "/api/videos", [
            "title" => "The ranch 222",
            "description" => "The ranch is one serie",
            "year_launched" => 2018,
            "opened" => false,
            "rating" => "16",
            "duration" => 50,
            "categories_id" => [
                $category[0]->id
            ],
            "genres_id" => [
                $genre[0]->id
            ]
        ]);
        $response->assertStatus(201);
    }

    public function testUpdateFailInvalidData()
    {

        $video = Video::create();
        $response = $this->json("PUT", "/api/videos" . $video[0]->id, []);
        $response->assertStatus(422);
    }

    // public function testCreateSuccess()
    // {
    //     $response = $this->json("POST", "/api/videos", [
    //         "title" => "The ranch 222",
    //         "description" => "The ranch is one serie",
    //         "year_launched" => 2018,
    //         "opened" => false,
    //         "rating" => "16",
    //         "duration" => 50,
    //         "categories_id" => ["0295a02d-1084-4368-b485-9ca8b5729a80"],
    //         "genres_id" => [5]
    //     ]);
    //     $response->assertStatus(204);
    // }
}
