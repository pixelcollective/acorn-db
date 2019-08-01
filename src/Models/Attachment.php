<?php

namespace TinyPixel\Acorn\Models\Models;

use TinyPixel\Acorn\Models\Models\BaseModel;

class Attachment extends BaseModel
{
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_parent', 'ID');
    }
}
