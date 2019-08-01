<?php

namespace TinyPixel\Acorn\Models\Models\Term;

use TinyPixel\Acorn\Models\Models\BaseModel;

class Meta extends BaseModel
{
    protected $table      = 'term_meta';
    protected $primaryKey = 'meta_id';
    protected $fillable   = [
        'meta_key',
        'meta_value',
    ];
}
