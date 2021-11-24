<?php

namespace Tests\Unit;

use App\Model\Genre;
use PHPUnit\Framework\TestCase;

class GenreTest extends TestCase
{

    public function testFillable()
    {
        $genre = new Genre();
        $this->assertEquals(['name', 'is_active'], $genre->getFillable());
    }

    public function testDates()
    {
        $genre = new Genre();
        $this->assertEquals(['created_at', 'updated_at'], $genre->getDates());
    }
}
