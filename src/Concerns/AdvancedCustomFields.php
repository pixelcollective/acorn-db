<?php
namespace AcornDB\Concerns;

use AcornDB\ACF\AdvancedCustomFields as BaseAdvancedCustomFields;

/**
 * Trait HasAcfFields
 *
 * @author Junior Grossi <juniorgro@gmail.com>
 */
trait AdvancedCustomFields
{
    /**
     * @return AdvancedCustomFields
     */
    public function getAcfAttribute()
    {
        return new BaseAdvancedCustomFields($this);
    }
}
