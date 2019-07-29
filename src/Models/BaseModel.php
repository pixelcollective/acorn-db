<?php

namespace TinyPixel\AcornModels;

include __DIR__ . '/../../vendor/autoload.php';

use Sofa\Eloquence\Eloquence;
use Sofa\Eloquence\Mappable;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class BaseModel extends EloquentModel
{
    use Eloquence, Mappable;
}