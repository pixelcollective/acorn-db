<?php

namespace TinyPixel\Acorn\Database\Model;

use TinyPixel\Acorn\Database\Model\WordPress;

class Links extends WordPress
{
    protected $table      = 'links';
    protected $primaryKey = 'link_id';
    public $timestamps    = false;
}
