<?php

namespace TinyPixel\Models\Term;

use \TinyPixel\Models\Term;
use \Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    protected $table = 'term_taxonomy';

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id', 'term_id');
    }
}
