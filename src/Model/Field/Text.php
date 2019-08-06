<?php

namespace TinyPixel\Acorn\Database\Model\Field;

use TinyPixel\Acorn\Database\Model\Field\Field;
use TinyPixel\Acorn\Database\Model\Field\FieldInterface;

/**
 * Text Field
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 * @version    1.0.0
 * @package    Acorn\Database
 * @subpackage Model\Field
 * @implements TinyPixel\Acorn\Database\Model\Field\FieldInterface
 * @extends    TinyPixel\Acorn\Database\Model\Field\Field
 */
class Text extends Field implements FieldInterface
{
    /** @var string */
    protected $value;

    /**
     * Process field.
     *
     * @param  string $field
     * @return void
     */
    public function process($field) : void
    {
        $this->value = $this->fetchValue($field);
    }

    /**
     * Getter.
     *
     * @return string
     */
    public function get() : string
    {
        return $this->value;
    }
}
