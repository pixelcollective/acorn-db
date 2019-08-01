<?php

namespace TinyPixel\Acorn\Models\Models\Term;

use TinyPixel\Acorn\Models\Models\BaseModel;

class Relationships extends BaseModel
{
    protected $table = 'term_relationships';
    protected $primaryKey = 'term_taxonomy_id';
}
