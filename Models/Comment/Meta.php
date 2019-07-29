<?php

namespace App\Models\Comment;

use App\Models\Comment;

use TinyPixel\AcornModels\Model;

class Meta extends Model
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
