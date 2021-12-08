<?php

namespace Tests\Unit;

use App\Model\Video;
use PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testFillable()
    {
        $fillable = [
            'duration', 'title', 'description',
            'year_launched', "opened", "rating"
        ];  
        $video = new Video();
        $this->assertCount(count($fillable), $video->getFillable());
    }

    public function testHidden()
    {
        $hidden = [
            "deleted_at", "created_at", "updated_at"
        ];  
        $video = new Video();
        $this->assertCount(count($hidden), $video->getHidden());
    }

    public function testCast()
    {
        $casts = [
            "id" => "string"
        ];  
        $video = new Video();
        $this->assertArrayHasKey("id", $video->getCasts());
        $this->assertCount(count($casts), $video->getCasts());

    }
}
