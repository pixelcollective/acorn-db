<?php

namespace TinyPixel\AcornModels\Models\Term;

use TinyPixel\AcornModels\Models\BaseModel;

class Relationships extends BaseModel
{
    protected $table = 'term_relationships';
    protected $primaryKey = 'term_taxonomy_id';
}
