<?php

namespace TinyPixel\Acorn\Database\Model;

use Illuminate\Database\Eloquent\Builder;
use TinyPixel\Acorn\Database\Model\Post;
use TinyPixel\Acorn\Database\Model\Option;

/**
 * Page Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    Acorn\Database
 * @subpackage Model\Page
 ***/
class Page extends Post
{
    /**
     * Returns the front page.
     *
     * @param Builder $query
     * @return mixed
     ***/
    public function scopeHome(Builder $query)
    {
        $results = $query->where('ID', Option::get('page_on_front'));

        return $results->first();
    }
}
