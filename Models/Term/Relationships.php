<?php

namespace App\Models\Relationships;

use TinyPixel\Acorn\Database\Models\Term\Relationships as RelationshipsModel;

class Relationships extends RelationshipsModel
{
    protected $table = 'term_relationships';
    protected $primaryKey = 'term_taxonomy_id';
}
