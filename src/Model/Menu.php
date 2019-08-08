<?php

namespace TinyPixel\AcornDB\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use TinyPixel\AcornDB\Model\MenuItem;
use TinyPixel\AcornDB\Model\WordPress;
use TinyPixel\AcornDB\Model\Taxonomy;

/**
 * Menu Model
 *
 * @author  Kelly Mears <kelly@tinypixel.dev>
 * @license MIT
 * @since   1.0.0
 * @uses    Sofa\Eloquence\Eloquence
 *
 * @package    AcornDB
 * @subpackage Model\Menu
 **/
class Menu extends Taxonomy
{
    /** @var string */
    protected $taxonomy = 'nav_menu';

    /** @var array */
    protected $with = ['term', 'items'];

    /**
     * A menu can be parented by many menu items.
     *
     * @return BelongsToMany
     **/
    public function items() : BelongsToMany
    {
        return $this->belongsToMany(
            MenuItem::class,
            'term_relationships',
            'term_taxonomy_id',
            'object_id'
        )->orderBy('menu_order');
    }
}
