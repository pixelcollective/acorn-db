<?php

namespace TinyPixel\AcornModels\Models\User;

use TinyPixel\AcornModels\Models\User;

use TinyPixel\AcornModels\Models\BaseModel;

class Meta extends BaseModel
{
    protected $table      = 'usermeta';
    public $timestamps    = false;
    protected $primaryKey = 'umeta_id';
    protected $fillable   = [
        'meta_key',
        'meta_value',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
