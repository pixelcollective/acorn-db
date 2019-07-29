<?php

namespace TinyPixel\AcornModels\Models;

use TinyPixel\AcornModels\Models\BaseModel;

class Links extends BaseModel
{
    protected $table      = 'links';
    protected $primaryKey = 'link_id';
    public $timestamps    = false;
}
