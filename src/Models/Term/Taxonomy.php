<?php

namespace TinyPixel\AcornModels\Models\Term;

use TinyPixel\AcornModels\Models\Term;

use TinyPixel\AcornModels\Models\BaseModel;

class Taxonomy extends BaseModel
{
    protected $table = 'term_taxonomy';

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id', 'term_id');
    }
}
