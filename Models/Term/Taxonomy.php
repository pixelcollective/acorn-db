<?php

namespace App\Models\Taxonomy;

use TinyPixel\AcornModels\Models\Term\Taxonomy as TaxonomyModel;

class Taxonomy extends BaseModel
{
    protected $table = 'term_taxonomy';

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id', 'term_id');
    }
}
