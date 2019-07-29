<?php

namespace TinyPixel\AcornModels\Models;

use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class BaseModel extends EloquentModel
{
    use Eloquence, Mappable;
}