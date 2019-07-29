<?php

namespace TinyPixel\AcornModels\Models;

use TinyPixel\AcornModels\Models\TermMeta as TermMeta;

use TinyPixel\AcornModels\Models\Traits\HasMeta;
use TinyPixel\AcornModels\Models\BaseModel;

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
