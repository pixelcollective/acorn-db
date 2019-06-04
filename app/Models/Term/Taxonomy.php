<?php

namespace App\Models\Term;

use \App\Models\Term;
use \Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    protected $table = 'term_taxonomy';

    public function term()
    {
        return $this->belongsTo(Term::class, 'term_id', 'term_id');
    }
}
