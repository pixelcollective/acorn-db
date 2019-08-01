<?php

namespace TinyPixel\Acorn\Models\Models;

use TinyPixel\Acorn\Support\Utility;
use TinyPixel\Acorn\Models\Models\BaseModel;

class Option extends BaseModel
{
    protected $table      = 'options';
    protected $primaryKey = 'option_id';
    public    $timestamps    = false;

    public static function getValue($key = '')
    {
        $value = '';

        if ($key) {
            $value = self::where('option_name', '=', $key)->value('option_value');
        }

        if (Utility::isSerialized($value)) {
            $value = unserialize($value);
        }

        return $value;
    }
}
