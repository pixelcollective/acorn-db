<?php

namespace TinyPixel\AcornDB\Exception;

use Exception;
use Log;

/**
 * Eloquent Exception
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    AcornDB
 * @subpackage Exceptions
 **/
class EloquentException extends Exception
{
    /**
     * Log exception.
     *
     * @return void
     **/
    public function log($exception) : void
    {
        Log::debug($exception);
    }
}
