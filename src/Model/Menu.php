<?php

namespace TinyPixel\AcornDB\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use TinyPixel\AcornDB\Model\MenuItem;
use TinyPixel\AcornDB\Model\WordPress;
use TinyPixel\AcornDB\Model\Taxonomy;

/**
 * Menu Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @version    1.0.0
 * @since      1.0.0
 *
 * @package    AcornDB
 * @subpackage Model
 **/
class Menu extends Taxonomy
{
    /**
     * Specify relationships to be eager-loaded.
     *
     * @var string
     */
    protected $taxonomy = 'nav_menu';

    /**
     * Specify relationships to be eager-loaded.
     *
     * @var string
     */
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
