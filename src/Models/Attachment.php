<?php

namespace TinyPixel\Acorn\Database\Models;

use TinyPixel\Acorn\Database\Models\BaseModel;

class Attachment extends BaseModel
{
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_parent', 'ID');
    }
}
