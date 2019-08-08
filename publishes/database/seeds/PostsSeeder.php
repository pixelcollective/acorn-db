<?php

use function Roots\Acorn\Application\factory;
use Illuminate\Database\Seeder;

use App\Model\Post;
use App\Model\User;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        print_r(factory(User::class, 3)->make());

        // $faker = Faker::create(Post::class);
        // $this->seedPosts($faker, 20);
    }

    /**
     * Seed posts
     *
     * @param  object $faker
     * @param  int    $count
     * @return void
     */
    protected function seedPosts($faker, $count)
    {
        for ($i = 0; $i <= 20; $i++) {
            DB::table('posts')->insert([
                'post_title'    => $faker->title(),
                'post_excerpt'  => $faker->sentence(),
                'post_content'  => $faker->paragraph(),
                'post_date'     => Carbon::now()->toDateTimeString(),
                'post_date_gmt' => Carbon::now('gmt')->toDateTimeString(),
                'post_modified' => Carbon::now()->toDateTimeString(),
                'post_modified_gmt' => Carbon::now('gmt')->toDateTimeString(),
                'post_author'   => 1,
                'to_ping'       => '',
                'pinged'        => '',
                'post_content_filtered' => '',
                'post_name'     => $faker->slug(),
            ]);
        }
    }
}
