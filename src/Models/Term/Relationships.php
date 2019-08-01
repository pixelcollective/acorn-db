<?php

namespace TinyPixel\Acorn\Database\Models\Term;

use TinyPixel\Acorn\Database\Models\BaseModel;

class Relationships extends BaseModel
{
    protected $table = 'term_relationships';
    protected $primaryKey = 'term_taxonomy_id';
}
