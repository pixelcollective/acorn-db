<?php

namespace TinyPixel\Acorn\Database\Models\User;

use TinyPixel\Acorn\Database\Models\User;
use TinyPixel\Acorn\Database\Models\BaseModel;

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
