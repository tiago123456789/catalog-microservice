<?php

namespace Tests\Unit;

use App\Model\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase
{
    public function testFillable()
    {
        $fillable = ['name', 'description', 'is_active'];
        $category = new Category();
        $this->assertEquals($fillable, $category->getFillable());
    }

    public function testCasts()
    {
        $casts = [
            "id" => "string"
        ];
        $category = new Category();
        $this->assertEquals($casts, $category->getCasts());
    }

    public function testDates() {
        $dates = ["deleted_at", "created_at", "updated_at"];
        $category = new Category();
        foreach($dates as $date) {
            $this->assertContains($date, $dates);
        }
        $this->assertCount(count($dates), $category->getDates());
    }

    public function testIncrementIsFalse()
    {
        $category = new Category();
        $this->assertFalse($category->incrementing);
    }
}
