<?php

namespace TinyPixel\AcornModels\Models\Post;

use TinyPixel\AcornModels\Models\Post;

use TinyPixel\AcornModels\Models\BaseModel;

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
