<?php

namespace TinyPixel\Acorn\Database\Models\Comment;

use TinyPixel\Acorn\Database\Models\Comment;
use TinyPixel\Acorn\Database\Models\BaseModel;

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
