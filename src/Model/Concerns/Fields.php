<?php

namespace TinyPixel\Acorn\Database\Model\Concerns;

use TinyPixel\Acorn\Database\Model\Field\FieldManager;

/**
 * Concerning fields.
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 *
 * @package    Acorn\Database
 * @subpackage Model\Traits
 **/
trait Fields
{
    /**
     * Get field attributes.
     *
     * @return FieldManager
     **/
    public function getFieldAttributes() : FieldManager
    {
        return new FieldManager($this);
    }
}
