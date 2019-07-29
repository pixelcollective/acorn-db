<?php

namespace App\Models;

use App\Models\Traits\HasMeta;
use App\Models\TermMeta as TermMeta;

use TinyPixel\AcornModels\Model;

class Term extends Model
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
