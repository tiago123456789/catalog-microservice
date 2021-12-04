<?php

use App\Model\Video;
use Illuminate\Database\Seeder;

class VideoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Video::class, 100)->create();

    }
}
