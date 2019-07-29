<?php

namespace App\Models\Post;

use TinyPixel\AcornModels\Models\Post\Meta as PostMetaModel;

class Meta extends PostMetaModel
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
