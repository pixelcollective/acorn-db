<?php

namespace TinyPixel\Acorn\Models\Models;

use TinyPixel\Acorn\Models\Models\TermMeta as TermMeta;
use TinyPixel\Acorn\Models\Models\Traits\HasMeta;
use TinyPixel\Acorn\Models\Models\BaseModel;

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
