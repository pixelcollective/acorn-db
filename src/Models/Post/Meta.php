<?php

namespace TinyPixel\Acorn\Database\Models\Post;

use TinyPixel\Acorn\Database\Models\Post;
use TinyPixel\Acorn\Database\Models\BaseModel;

class Meta extends BaseModel
{
    protected $table      = 'postmeta';
    public $timestamps    = false;
    protected $primaryKey = 'meta_id';
    protected $fillable   = [
        'meta_key',
        'meta_value',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
