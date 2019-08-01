<?php

namespace TinyPixel\Acorn\Models\Models\Term;

use TinyPixel\Acorn\Models\Models\Term;
use TinyPixel\Acorn\Models\Models\BaseModel;

class Taxonomy extends BaseModel
{
    protected $table = 'term_taxonomy';

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id', 'term_id');
    }
}
