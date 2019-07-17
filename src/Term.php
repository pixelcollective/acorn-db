<?php

namespace TinyPixel\Models;

use \TinyPixel\Models\{
    Traits\HasMeta,
    TermMeta as TermMeta,
};

use \Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasMeta;

    protected $table = 'terms';
    protected $primaryKey = 'term_id';

    public function meta()
    {
        return $this->hasMany(TermMeta::class, 'term_id')
                    ->select(['term_id', 'meta_key', 'meta_value']);
    }
}
