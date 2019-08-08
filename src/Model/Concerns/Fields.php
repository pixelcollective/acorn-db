<?php

namespace TinyPixel\Acorn\Database\Model\Concerns;

use TinyPixel\Acorn\Database\Model\Field\FieldManager;

/**
 * Concerning fields.
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @version    1.0.0
 * @since      1.0.0
 *
 * @package    Acorn\Database
 * @subpackage Model\Concerns
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
