<?php

namespace TinyPixel\Acorn\Models\Models;

use TinyPixel\Acorn\Models\Models\BaseModel;

class Links extends BaseModel
{
    protected $table      = 'links';
    protected $primaryKey = 'link_id';
    public $timestamps    = false;
}
