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
 * @version    1.0.0
 * @since      1.0.0
 *
 * @package    AcornDB
 * @subpackage Model
 */
class Page extends Post
{
    /**
     * Returns the front page.
     *
     * @param Builder $query
     * @return mixed
     */
    public function scopeHome(Builder $query)
    {
        $results = $query->where('ID', Option::get('page_on_front'));

        return $results->first();
    }
}
