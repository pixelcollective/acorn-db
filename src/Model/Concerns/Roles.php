<?php

namespace TinyPixel\AcornDB\Model\Concerns;

/**
 * Concerning user roles
 *
 * @author     Kelly Mears <kelly@tinypixel.dev>
 * @license    MIT
 * @since      1.0.0
 *
 * @package    AcornDB
 * @subpackage Model\Concerns
 **/
trait Roles
{
    public function hasRole($role = '')
    {
        return in_array($role, $this->capabilities);
    }

    public function hasAnyRoles($roles = [])
    {
        if (!empty($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        }

        return false;
    }

    public function getCapabilitiesAttribute()
    {
        return array_keys($this->getMeta('wp_capabilities'));
    }

    public function getIsAdminAttribute()
    {
        return $this->hasRole('administrator');
    }
}
