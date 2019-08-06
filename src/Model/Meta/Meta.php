<?php

namespace TinyPixel\Acorn\Database\Model\Meta;

use TinyPixel\Acorn\Database\Model\WordPress;
use TinyPixel\Acorn\Database\Collection\MetaCollection;
use TinyPixel\Acorn\Database\Exceptions\EloquentException;

/**
 * Meta Model
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @uses       Sofa\Eloquence\Eloquence
 *
 * @package    AcornDB
 * @subpackage Model
 */
abstract class Meta extends WordPress
{
    /** @var string */
    protected $primaryKey = 'meta_id';

    /** @var bool */
    public $timestamps = false;

    /**
     * Get value attribute.
     *
     * @return mixed
     * @throws EloquentException
     */
    public function getValueAttribute()
    {
        try {
            $value = unserialize($this->meta_value);
            return $value === false && $this->meta_value !== false ?
                $this->meta_value : $value;
        } catch (EloquentException $ex) {
            return $this->meta_value;
        }
    }

    /**
     * Create new collection instance.
     *
     * @param  array $Model
     * @return MetaCollection
     */
    public function newCollection(array $model = [])
    {
        return new MetaCollection($model);
    }
}
