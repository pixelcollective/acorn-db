<?php

namespace TinyPixel\AcornDB\Exception;

use Exception;
use Log;

/**
 * Eloquent Exception
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
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
