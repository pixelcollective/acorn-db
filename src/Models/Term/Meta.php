<?php

namespace TinyPixel\Acorn\Database\Models\Term;

use TinyPixel\Acorn\Database\Models\BaseModel;

class Meta extends BaseModel
{
    protected $table      = 'term_meta';
    protected $primaryKey = 'meta_id';
    protected $fillable   = [
        'meta_key',
        'meta_value',
    ];
}
