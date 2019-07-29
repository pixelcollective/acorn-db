<?php

namespace TinyPixel\AcornModels\Models;

use TinyPixel\AcornModels\Models\BaseModel;

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

        if (WordPress::isSerialized($value)) {
            $value = unserialize($value);
        }

        return $value;
    }
}
