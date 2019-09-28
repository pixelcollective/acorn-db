<?php
namespace TinyPixel\AcornDB\Model\Meta;

use Exception;
use TinyPixel\AcornDB\Model\Model;
use TinyPixel\AcornDB\Model\Collection\MetaCollection;

/**
 * Meta
 *
 * @author Junior Grossi <juniorgro@gmail.com>
 */
abstract class Meta extends Model
{
    /**
     * @var string
     */
    protected $primaryKey = 'meta_id';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $appends = ['value'];

    /**
     * @return mixed
     */
    public function getValueAttribute()
    {
        try {
            $value = unserialize($this->meta_value);

            return $value === false && $this->meta_value !== false
                ? $this->meta_value
                : $value;
        } catch (Exception $ex) {
            return $this->meta_value;
        }
    }

    /**
     * @param array $models
     * @return MetaCollection
     */
    public function newCollection(array $models = [])
    {
        return new MetaCollection($models);
    }
}
