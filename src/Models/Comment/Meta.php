<?php

namespace TinyPixel\AcornModels\Models\Comment;

use TinyPixel\AcornModels\Models\Comment;

use TinyPixel\AcornModels\Models\BaseModel;

class Meta extends BaseModel
{
    protected $table   = 'commentmeta';
    public $timestamps = false;
    protected $fillable = ['meta_key', 'meta_value'];
    protected $primaryKey = 'meta_id';

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
