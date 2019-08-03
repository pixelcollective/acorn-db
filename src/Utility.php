<?php

namespace TinyPixel\Acorn\Database;

/**
 * Utility
 *
 * @author  Kelly Mears <kelly@tinypixel.dev>
 * @license MIT
 * @since   1.0.0
 *
 * @package    Acorn
 * @subpackage Support
 *
 */
class Utility
{
    /**
     * Is Serialized
     *
     * @param  string $data
     * @param  bool   $strict
     * @return bool
     */
    public static function isSerialized($data, $strict = true)
    {
        if (!is_string($data)) {
            return false;
        }

        $data = trim($data);

        if ('N;' == $data) {
            return true;
        }

        if (strlen($data) < 4) {
            return false;
        }

        if (':' !== $data[1]) {
            return false;
        }

        if ($strict) {
            $lastc = substr($data, -1);

            if (';' !== $lastc && '}' !== $lastc) {
                return false;
            }
        } else {
            $semicolon = strpos($data, ';');
            $brace     = strpos($data, '}');

            if (false === $semicolon && false === $brace) {
                return false;
            }

            if (false !== $semicolon && $semicolon < 3) {
                return false;
            }

            if (false !== $brace && $brace < 4) {
                return false;
            }
        }

        $token = $data[0];

        switch ($token) {
            case 's':
                if ($strict) {
                    if ('"' !== substr($data, -2, 1)) {
                        return false;
                    }
                } elseif (false === strpos($data, '"')) {
                    return false;
                }
                // no break
            case 'a':
                // fallthrough
            case 'O':
                return (bool) preg_match("/^{$token}:[0-9]+:/s", $data);
            case 'b':
                // fallthrough
            case 'i':
                // fallthrough
            case 'd':
                $end = $strict ? '$' : '';
                return (bool) preg_match("/^{$token}:[0-9.E-]+;$end/", $data);
        }

        return false;
    }

    /**
     * Convert path to namespace
     *
     * @param  string $path
     * @return string
     */
    public static function pathToNamespace($path)
    {
        return str_replace('/', '\\', $path);
    }
}
