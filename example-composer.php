<?php

namespace App\Composers;

use Roots\Acorn\View\Composer;

use \App\Models\Post;

class AllPosts extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.content',
        'partials.content-*'
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @param  array $data
     * @param  \Illuminate\View\View $view
     * @return array
     */
    public function with($data, $view)
    {
        return ['posts'  => $this->posts()];
    }

    public function posts()
    {
        return Post::all()->toArray();
    }
}
