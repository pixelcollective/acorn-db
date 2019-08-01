<?php

namespace App\Models\Taxonomy;

use TinyPixel\Acorn\Database\Models\Term\Taxonomy as TaxonomyModel;

class Taxonomy extends BaseModel
{
    protected $table = 'term_taxonomy';

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id', 'term_id');
    }
}
