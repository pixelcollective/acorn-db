<?php
namespace TinyPixel\AcornDB\Model;

use Illuminate\Support\Arr;
use TinyPixel\AcornDB\Model\Post;
use TinyPixel\AcornDB\Model\Page;
use TinyPixel\AcornDB\Model\CustomLink;
use TinyPixel\AcornDB\Model\Taxonomy;

/**
 * WordPress Menu Item
 *
 * @author Junior Grossi <juniorgro@gmail.com>
 */
class MenuItem extends Post
{
    /**
     * @var string
     */
    protected $postType = 'nav_menu_item';

    /**
     * @var array
     */
    protected $instanceRelations = [
        'post' => Post::class,
        'page' => Page::class,
        'custom' => CustomLink::class,
        'category' => Taxonomy::class,
    ];

    /**
     * @return Post|Page|CustomLink|Taxonomy
     */
    public function parent()
    {
        if ($className = $this->getClassName()) {
            return (new $className())->newQuery()
                ->find($this->meta->_menu_item_menu_item_parent);
        }

        return null;
    }

    /**
     * @return Post|Page|CustomLink|Taxonomy
     */
    public function instance()
    {
        if ($className = $this->getClassName()) {
            return (new $className())->newQuery()
                ->find($this->meta->_menu_item_object_id);
        }

        return null;
    }

    /**
     * @return string
     */
    protected function getClassName()
    {
        return Arr::get(
            $this->instanceRelations,
            $this->meta->_menu_item_object
        );
    }
}
