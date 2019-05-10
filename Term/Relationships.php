<?php

namespace App\Models\Term;

use \Illuminate\Database\Eloquent\Model;

class Relationships extends Model
{
    protected $table = 'term_relationships';
    protected $primaryKey = 'term_taxonomy_id';
}
