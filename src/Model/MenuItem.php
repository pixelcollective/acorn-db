<?php

namespace TinyPixel\AcornDB\Model;

use Illuminate\Support\Arr;
use TinyPixel\AcornDB\Model\Post;
use TinyPixel\AcornDB\Model\Page;
use TinyPixel\AcornDB\Model\Link;
use TinyPixel\AcornDB\Model\Taxonomy;

/**
 * Menu Item Model
 *
 * @author  Kelly Mears <kelly@tinypixel.dev>
 * @license MIT
 * @since   1.0.0
 *
 * @package    AcornDB
 * @subpackage Model\MenuItem
 **/
class MenuItem extends Post
{
    /** @var string  **/
    protected $postType = 'nav_menu_item';

    /** @var array */
    protected $instanceRelations = [
        'post'     => Post::class,
        'page'     => Page::class,
        'link'     => Link::class,
        'category' => Taxonomy::class,
    ];

    /**
     * Get parent instance type.
     *
     * @return Post|Page|Link|Taxonomy
     **/
    public function parent()
    {
        if ($className = $this->getClassName()) {
            $class = new $className();

            $class->newQuery()
                  ->find($this->meta->_menu_item_menu_item_parent);
        }

        return null;
    }

    /**
     * Get instance type.
     *
     * @return Post|Page|Link|Taxonomy
     **/
    public function instance()
    {
        if ($className = $this->getClassName()) {
            $class = new $className();

            $class->newQuery()
                  ->find($this->meta->_menu_item_object_id);
        }

        return null;
    }

    /**
     * Get classname of related instance.
     *
     * @return string
     **/
    protected function getClassName()
    {
        return Arr::get($this->instanceRelations, $this->meta->_menu_item_object);
    }
}
