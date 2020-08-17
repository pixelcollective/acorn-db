<?php

use AcornDB\Seeder;
use Corcel\Model\Post;

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
