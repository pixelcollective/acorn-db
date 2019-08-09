<?php

namespace TinyPixel\AcornDB\Model;

use TinyPixel\AcornDB\Model\WordPress;

/**
 * Link Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @version    1.0.0
 * @since      1.0.0
 *
 * @package    AcornDB
 * @subpackage Model
 **/
class Link extends WordPress
{
    /** @var string */
    protected $table = 'links';

    /** @var string */
    protected $primaryKey = 'link_id';

    /** @var bool */
    public $timestamps = false;
}
