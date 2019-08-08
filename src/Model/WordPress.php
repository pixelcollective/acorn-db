<?php

namespace TinyPixel\Acorn\Database\Model;

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
 * @package    Acorn\Database
 * @subpackage Model\WordPress
 **/
class WordPress extends Model
{
    use Eloquence, Mappable;
}
