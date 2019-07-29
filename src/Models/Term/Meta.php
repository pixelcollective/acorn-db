<?php

namespace App\Models\Term;

use \Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    protected $table      = 'term_meta';
    protected $primaryKey = 'meta_id';
    protected $fillable   = [
        'meta_key',
        'meta_value',
    ];
}
