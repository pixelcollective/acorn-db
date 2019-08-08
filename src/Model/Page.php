<?php

namespace TinyPixel\AcornDB\Model;

use Illuminate\Database\Eloquent\Builder;
use TinyPixel\AcornDB\Model\Post;
use TinyPixel\AcornDB\Model\Option;

/**
 * Page Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    AcornDB
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
