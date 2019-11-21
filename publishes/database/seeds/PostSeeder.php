<?php

use AcornDB\Model\Post;
use AcornDB\Seeder;

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
