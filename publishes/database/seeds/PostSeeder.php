<?php

use App\Model\Post;
use TinyPixel\AcornDB\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->factory(Post::class, 3)->create();
    }
}
