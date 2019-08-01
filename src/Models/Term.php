<?php

namespace TinyPixel\Acorn\Database\Models;

use TinyPixel\Acorn\Database\Models\TermMeta as TermMeta;
use TinyPixel\Acorn\Database\Models\Traits\HasMeta;
use TinyPixel\Acorn\Database\Models\BaseModel;

class Term extends BaseModel
{
    use HasMeta;

    protected $table      = 'terms';
    protected $primaryKey = 'term_id';

    public function meta()
    {
        return $this->hasMany(TermMeta::class, 'term_id')
                    ->select(['term_id', 'meta_key', 'meta_value']);
    }
}
