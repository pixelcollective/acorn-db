<?php

namespace TinyPixel\AcornDB\Model\Field;

use TinyPixel\AcornDB\Model\Model;
use TinyPixel\AcornDB\Model\Field\FieldFactory;
use TinyPixel\AcornDB\Exceptions\EloquentException;

/**
 * Field Manager
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 *
 * @package    AcornDB
 * @subpackage Model\Field
 **/
class FieldManager
{
    /** @var mixed **/
    protected $post;

    /**
     * Constructor.
     *
     * @param  Model $post
     * @return void
     ***/
    public function __construct(Model $post)
    {
        $this->post = $post;
    }

    /**
     * Getter.
     *
     * @param  string $name
     * @return mixed
     **/
    public function __get(string $name)
    {
        $field = FieldFactory::make($name, $this->post);
        return $field ? $field->get() : null;
    }

    /**
     * Convenience method for accessing field data.
     *
     * @param  string $name
     * @param  array  $arguments
     * @return mixed
     * @uses   FieldFactory
     * @throws EloquentException
     **/
    public function __call(string $name, array $arguments)
    {
        if (!isset($arguments[0])) {
            throw new EloquentException('The field name is missing');
        }

        $field = FieldFactory::make(
            $arguments[0],
            $this->post,
            snake_case($name)
        );

        return $field ? $field->get() : null;
    }
}
