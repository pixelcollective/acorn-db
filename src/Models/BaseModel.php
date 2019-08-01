<?php

namespace TinyPixel\Acorn\Database\Models;

use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class BaseModel extends EloquentModel
{
    use Eloquence, Mappable;
}