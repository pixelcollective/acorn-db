<?php

namespace TinyPixel\AcornDB\Model;

use TinyPixel\AcornDB\Model\WordPress;

/**
 * Link
 *
 * @author  Kelly Mears <kelly@tinypixel.dev>
 * @license MIT
 * @since   1.0.0
 *
 * @package    AcornDB
 * @subpackage Model\Link
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
