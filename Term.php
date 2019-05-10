<?php

namespace App\Models;

use \App\Helpers\Traits\HasMeta;
use \Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasMeta;

    protected $table = 'terms';
    protected $primaryKey = 'term_id';

    public function meta()
    {
        return $this->hasMany(\App\Models\Term\Meta::class, 'term_id')
                    ->select(['term_id', 'meta_key', 'meta_value']);
    }
}
