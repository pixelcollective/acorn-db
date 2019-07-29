<?php

namespace App\Models\Term;

use TinyPixel\AcornModels\Model;

class Relationships extends Model
{
    protected $table = 'term_relationships';
    protected $primaryKey = 'term_taxonomy_id';
}
