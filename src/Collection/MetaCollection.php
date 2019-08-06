<?php

namespace TinyPixel\Acorn\Database\Collection;

use Illuminate\Database\Eloquent\Collection;

/**
 * Meta Collection
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    Acorn\Database
 * @subpackage Collection
 **/
class MetaCollection extends Collection
{
    /**
     * Getter.
     *
     * @param  string $key
     * @return mixed
     **/
    public function __get($key)
    {
        if (isset($this->items) && count($this->items)) {
            $meta = $this->first(function ($meta) use ($key) {
                return $meta->meta_key === $key;
            });

            return $meta ? $meta->meta_value : null;
        }

        return null;
    }

    /**
     * Conditional getter.
     *
     * @param  string $name
     * @return bool
     **/
    public function __isset($name)
    {
        return !is_null($this->__get($name));
    }
}
