<?php

namespace App\Models\Comment;

use TinyPixel\Acorn\Database\Models\Models\Comment\Meta as CommentMetaModel;

class Meta extends CommentMetaModel
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
