<?php

namespace TinyPixel\AcornModels\Models\Term;

use TinyPixel\AcornModels\Models\BaseModel;

class Meta extends BaseModel
{
    protected $table      = 'term_meta';
    protected $primaryKey = 'meta_id';
    protected $fillable   = [
        'meta_key',
        'meta_value',
    ];
}
