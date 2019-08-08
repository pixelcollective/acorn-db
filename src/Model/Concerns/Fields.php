<?php

namespace TinyPixel\AcornDB\Model\Concerns;

use TinyPixel\AcornDB\Model\Field\FieldManager;

/**
 * Concerning fields.
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @version    1.0.0
 * @since      1.0.0
 *
 * @package    AcornDB
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
