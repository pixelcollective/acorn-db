<?php

namespace TinyPixel\AcornDB\Model;

use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;
use Illuminate\Database\Eloquent\Model;

/**
 * Base Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    AcornDB
 * @subpackage Model\WordPress
 **/
class WordPress extends Model
{
    use Eloquence, Mappable;

    /**
     * Disable illuminate timestamp behavior
     *
     * @var bool
     */
    public $timestamps = false;
}
