<?php

namespace TinyPixel\AcornDB\Model\Concerns;

/**
 * Concerning timestamps
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @version    1.0.0
 * @since      1.0.0
 *
 * @package    AcornDB
 * @subpackage Model\Concerns
 */
trait Timestamps
{
    /**
     * Format `created_at` column names
     * to follow WordPress convention.
     *
     * @param mixed $value
     * @return mixed
     */
    public function setCreatedAt($value)
    {
        $gmt_field = static::CREATED_AT . '_gmt';
        $this->{$gmt_field} = $value;

        return parent::setCreatedAt($value);
    }

    /**
     * Format `updated_at` column names
     * to follow WordPress convention.
     *
     * @param mixed $value
     * @return mixed
     */
    public function setUpdatedAt($value)
    {
        $gmt_field = static::UPDATED_AT . '_gmt';
        $this->{$gmt_field} = $value;

        return parent::setUpdatedAt($value);
    }
}
