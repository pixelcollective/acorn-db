<?php

namespace App\Models;

use TinyPixel\AcornModels\Model;

class Links extends Model
{
    protected $table      = 'links';
    protected $primaryKey = 'link_id';
    public $timestamps    = false;
}
