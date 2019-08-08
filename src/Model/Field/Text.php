<?php

namespace TinyPixel\AcornDB\Model\Field;

use TinyPixel\AcornDB\Model\Field\Field;
use TinyPixel\AcornDB\Model\Field\FieldInterface;

/**
 * Text Field
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @version    1.0.0
 * @package    AcornDB
 * @subpackage Model\Field
 * @implements TinyPixel\AcornDB\Model\Field\FieldInterface
 * @extends    TinyPixel\AcornDB\Model\Field\Field
 **/
class Text extends Field implements FieldInterface
{
    /** @var string */
    protected $value;

    /**
     * Process field.
     *
     * @param  string $field
     * @return void
     **/
    public function process($field) : void
    {
        $this->value = $this->fetchValue($field);
    }

    /**
     * Getter.
     *
     * @return string
     **/
    public function get() : string
    {
        return $this->value;
    }
}
