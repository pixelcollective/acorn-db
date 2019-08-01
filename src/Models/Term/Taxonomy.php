<?php

namespace TinyPixel\Acorn\Database\Models\Term;

use TinyPixel\Acorn\Database\Models\Term;
use TinyPixel\Acorn\Database\Models\BaseModel;

class Taxonomy extends BaseModel
{
    protected $table = 'term_taxonomy';

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id', 'term_id');
    }
}
