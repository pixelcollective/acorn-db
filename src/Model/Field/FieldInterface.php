<?php

namespace TinyPixel\Acorn\Database\Model\Field;

/**
 * Implementation contract for field types
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 *
 * @package    Acorn\Database
 * @subpackage Model\Field
 */
interface FieldInterface
{
    /**
     * Process field.
     *
     * @param string $fieldName
     **/
    public function process($fieldName);

    /**
     * Getter.
     *
     * @return mixed
     **/
    public function get();
}
