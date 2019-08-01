<?php

namespace TinyPixel\Acorn\Database\Models;

use TinyPixel\Acorn\Database\Models\BaseModel;

class Links extends BaseModel
{
    protected $table      = 'links';
    protected $primaryKey = 'link_id';
    public $timestamps    = false;
}
