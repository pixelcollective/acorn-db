<?php

namespace App\Models\Term;

use TinyPixel\AcornModels\Models\Term\Meta as TermMetaModel;

class Meta extends TermMetaModel
{
    protected $table      = 'term_meta';
    protected $primaryKey = 'meta_id';
    protected $fillable   = [
        'meta_key',
        'meta_value',
    ];
}
