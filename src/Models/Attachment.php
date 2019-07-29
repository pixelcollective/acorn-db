<?php

namespace TinyPixel\AcornModels\Models;

use TinyPixel\AcornModels\Models\BaseModel;

class Attachment extends BaseModel
{
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_parent', 'ID');
    }
}
